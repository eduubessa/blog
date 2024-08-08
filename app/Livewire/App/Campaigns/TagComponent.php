<?php

namespace App\Livewire\App\Campaigns;

use App\Models\Campaign;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TagComponent extends Component
{
    public string $code;
    public string $tag = "";
    public string $type = "create";

    public string $name = "";
    public array|Collection $suggestions = [];

    public array $tags = [];
    public mixed $campaign = null;

    public int $nav_suggestions = -1;

    #[On('tags-refresh')]
    public function refresh(): void
    {
        $this->tags = $this->campaign->tags->pluck('name', 'id')->toArray();
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
            $this->campaign->tags()->attach($tag->id);
            $this->dispatch('tags-refresh');
        }else{
            $this->tags = array_merge($this->tags, [$tag->id => $tag->name]);
        }

        $this->name = "";
        $this->suggestions = $this->suggestions->forget($key);

    }

    public function navNextSuggestionEventHandler(): void
    {

        if($this->nav_suggestions < $this->suggestions->count() - 1){
            $this->nav_suggestions++;
        }
    }

    public function navPrevSuggestionEventHandler(): void
    {
        if($this->nav_suggestions > 0){
            $this->nav_suggestions--;
        }
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
                $this->campaign->tags()->attach($tag->id);
                $this->dispatch('tags-refresh');
            }else{
                $this->tags = array_merge($this->tags, [$tag->id => $this->name]);
            }

        }else{
            $tag = $tags->first();
            if($this->type == "update"){
                $this->campaign->tags()->attach($tag->id);
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
            $this->campaign->tags()->detach($tag->id);
            $this->dispatch('tags-refresh');
        }else{
            $this->tags = $this->tags->forget($key);
        }
    }

    public function mount(): void
    {

        if ($this->type == "update" && $this->code) {
            $this->campaign = Campaign::with('tags')->where('code', $this->code)->firstOrFail();
            $this->tags = $this->campaign->tags->pluck('name', 'id')->toArray();
        }
    }

    public function render(): Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|View|Application
    {
        return view('livewire.app.campaigns.tag-component');
    }
}
