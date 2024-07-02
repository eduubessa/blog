<?php

namespace App\Livewire;

use App\Models\Campaign;
use Livewire\Component;

class CampaignsComponent extends Component
{
    public $campaigns;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function importClickEventHandler(): void
    {
        ImportCampaigns::dispatch(auth()->user());

        $this->campaigns = Campaign::all();
    }

    public function deleteClickEventHandler(int $id): void
    {
        Campaign::find($id)->delete();
        $this->campaigns = Campaign::all();
    }

    public function mount(): void
    {
        $this->campaigns = Campaign::all();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|View|Application
    {
        return view('livewire.campaigns-component');
    }
}
