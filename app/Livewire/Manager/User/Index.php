<?php

namespace App\Livewire\Manager\User;

use App\Models\Department;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = array(
            'department' => Department::all()
        );
        return view('livewire.manager.user.index', $data);
    }
}
