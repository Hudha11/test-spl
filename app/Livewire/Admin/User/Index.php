<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = array(
            'title' => 'Data Karyawan',
            'user' => User::select('name', 'email', 'role_id', 'department_id')
                ->with(['role', 'department'])
                ->get()
        );
        return view('livewire.admin.user.index', $data);
    }
}
