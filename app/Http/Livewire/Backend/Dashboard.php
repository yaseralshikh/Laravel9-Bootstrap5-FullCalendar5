<?php

namespace App\Http\Livewire\Backend;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $usersCount = User::where('status', 1)->count();
        $eventsCount = Event::where('status', 1)->count();
        return view('livewire.backend.dashboard',[
            'usersCount' => $usersCount,
            'eventsCount' => $eventsCount,
        ])->layout('layouts.admin');
    }
}
