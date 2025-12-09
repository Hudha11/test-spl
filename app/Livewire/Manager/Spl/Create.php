<?php

namespace App\Livewire\Manager\Spl;

use App\Models\Department;
use App\Models\Section;
use App\Models\Spl;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $title = 'Surat Perintah Lembur';

    public $kode_spl;
    public $department_id;
    public $section_id;
    public $notes;

    public $departments = [];
    public $sections = [];

    public function mount()
    {
        // Ambil semua department untuk dropdown
        $this->departments = Department::all();

        // Sections tidak perlu diambil semua (akan dinamis)
        $this->sections = [];

        // Generate kode SPL otomatis
        $this->kode_spl = 'SPL-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
    }

    public function updatedDepartmentId($value)
    {
        // Reset section
        $this->section_id = null;

        // Ambil section sesuai department_id
        $this->sections = Section::where('department_id', $value)->get();
    }

    public function save()
    {
        $this->validate([
            'department_id' => 'required|exists:departments,id',
            'section_id' => 'required|exists:sections,id',
            'notes' => 'nullable|string',
        ]);

        Spl::create([
            'kode_spl' => $this->kode_spl,
            'department_id' => $this->department_id,
            'section_id' => $this->section_id,
            'notes' => $this->notes,
            'status' => 'Approved', // Auto confirm karena role Manager
        ]);

        session()->flash('success', 'Surat Perintah Lembur berhasil dibuat.');

        return redirect()->route('manager.spl.index');
    }


    public function render()
    {
        return view('livewire.manager.spl.create');
    }
}
