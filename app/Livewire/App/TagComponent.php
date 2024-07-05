<?php

namespace App\Livewire\App;

use Illuminate\Support\Collection;
use Livewire\Component;

class TagComponent extends Component
{

    public array|Collection $tags;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.app.tag-component');
    }
}
