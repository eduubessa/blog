<?php

namespace App\Livewire\App\Campaigns;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class TagComponent extends Component
{
    public string $tag = "";
    public string $type = "create";
    public string|null $username = null;

    public string $name = "";
    public array|Collection $suggestions = [];

    public array $tags = [];
    public mixed $user = null;

    #[On('tags-refresh')]
    public function refresh()
    {
        $this->tags = $this->user->client->tags->pluck('name', 'id')->toArray();
    }

    public function findAndUpdateSuggestionsEventHandler(): void
    {
        if($this->name != ''){
            $this->suggestions = Tag::where("name", 'like', "%{$this->name}%")
                ->whereNotIn('id', array_keys($this->tags))
                ->get();
        }else{
            $this->suggestions = new Collection();
        }
    }

    public function addSuggestionClickEventHandler(string $value, int $key): void
    {
        $tag = Tag::where('name', $value)->first();

        if($this->type == "update"){
            $this->user->client->tags()->attach($tag->id);
            $this->dispatch('tags-refresh');
        }else{
            $this->tags = array_merge($this->tags, [$tag->id => $tag->name]);
        }

        $this->name = "";
        $this->suggestions = $this->suggestions->forget($key);

    }

    public function addOrCreateEventHandler(): void
    {

        $tags = Tag::where("name", 'like', "%{$this->name}%");

        if(!$tags->exists()){

            $tag = new Tag();
            $tag->name = $this->name;
            $tag->slug = Str::slug($this->name ."-". Str::random(8));
            $tag->save();

            if($this->type == "update"){
                $this->user->client->tags()->attach($tag->id);
                $this->dispatch('tags-refresh');
            }else{
                $this->tags = array_merge($this->tags, [$tag->id => $this->name]);
            }

        }else{
            $tag = $tags->first();
            if($this->type == "update"){
                $this->user->client->tags()->attach($tag->id);
            }else{
                $this->tags = array_merge($this->tags, [$tag->id => $tag->name]);
            }
        }

        $this->name = "";
    }

    public function findAndRemoveClickEventHandler(string $value, int $key): void
    {
        if($this->type == "update")
        {
            $tag = Tag::where('name', $value)->first();
            $this->user->client->tags()->detach($tag->id);
            $this->dispatch('tags-refresh');
        }else{
            $this->tags = $this->tags->forget($key);
        }
    }

    public function mount()
    {
        if ($this->type == "update" && $this->username) {
            $this->user = User::with('client', 'client.tags')->where('username', $this->username)->firstOrFail();
            $this->tags = $this->user->client->tags->pluck('name', 'id')->toArray();
        }
    }

    public function render()
    {
        return view('livewire.app.campaigns.tag-component');
    }
}
