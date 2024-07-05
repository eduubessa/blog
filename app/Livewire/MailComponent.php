<?php

namespace App\Livewire;

use App\Models\Mail;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class MailComponent extends Component
{

    public Collection $mails;

    public function mount()
    {
        $this->mails = Mail::all();
    }

    public function render()
    {
        return view('livewire.mail-component');
    }
}
