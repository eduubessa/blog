<?php

namespace App\Livewire;

use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientComponent extends Component
{
    use WithFileUploads;

    public $search;
    public $modal = false;
    public $client;
    public $files;


    protected $queryString = ['search'];

    public function save(): void
    {
        $this->validate([
            'files.*' => 'file|max:6144'
        ]);

        if(is_array($this->files)) {
            foreach ($this->files as $file) {
                $file->store('files');
            }
        }else{
            $this->files->store('files');
        }
    }

    public function delete(string $slug): void
    {
        $client = Client::with(['specialties', 'doctors'])->where('slug', $slug)->firstOrFail();

        if($client->specialties->count() > 0) {
            $client->specialties->delete();
        }

        if($client->doctors->count() > 0) {
            $client->doctors->delete();
        }

        $client->delete();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $clientsCount = Client::count();
        $clients = Client::with('user', 'tags')
            ->paginate(30);

        return view('livewire.client-component')
            ->with([
                'clients' => $clients,
                'clients_counter' => $clientsCount,
                'modal' => $this->modal
            ]);
    }
}
