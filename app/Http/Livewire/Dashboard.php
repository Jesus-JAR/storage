<?php

namespace App\Http\Livewire;

use App\Models\Bussines;
use App\Models\User;
use Livewire\Component;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class Dashboard extends Component
{
    public function render()
    {
        $logins = User::all()
            ->where('id', '=', auth()->id());
        return view('livewire.dashboard', compact('logins'));
    }
}
