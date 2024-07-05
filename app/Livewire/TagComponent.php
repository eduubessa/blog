<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TagComponent extends Component
{
    use WithPagination;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|View|Application
    {
        $tags = Tag::with('clients', 'campaigns', 'mails')->whereNull('deleted_at')->paginate(10);

        return view('livewire.tag-component')
            ->with(['tags' => $tags]);
    }
}
