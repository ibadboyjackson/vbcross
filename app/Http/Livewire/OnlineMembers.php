<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class OnlineMembers extends Component
{
    public function render()
    {
        $users = User::with('userAvatar')->orderBy('name')->get();
        return view('livewire.online-members' , compact('users'));
    }
}
