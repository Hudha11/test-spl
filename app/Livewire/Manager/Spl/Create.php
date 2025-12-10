<?php

namespace App\Livewire\Manager\Spl;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\{Spl, SplItem, Department, Section, User};
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $title = "Surat Perintah Lembur";
    public $editingId = null;

    public $kode_spl;
    public $department_id;
    public $section_id;
    public $notes;

    public $items = [];
    public $user = [];
    public $sections = [];

    protected $listeners = [
        'openCreateModal' => 'openModal',
        'openSplForm'     => 'loadEdit',   // <-- Listener Edit
    ];

    public function mount()
    {
        $this->generateKodeSpl();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->dispatch('showCreateModal'); // Trigger JS untuk buka modal
    }

    public function resetForm()
    {
        $this->reset(['department_id', 'section_id', 'notes', 'items', 'user', 'sections']);
        $this->generateKodeSpl();
    }

    public function updatedDepartmentId()
    {
        $this->section_id = null;
        $this->sections = Section::where('department_id', $this->department_id)->get();

        $this->user = [];
        $this->items = [];
    }

    public function updatedSectionId()
    {
        $this->user = User::where('section_id', $this->section_id)->get();
    }

    public function addItem()
    {
        $this->items[] = [
            'user_id'        => '',
            'date'           => date('Y-m-d'),
            'start_time'     => '08:00',
            'end_time'       => '17:00',
            'duration_hours' => 9
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $key)
    {
        [$index, $field] = explode('.', $key);

        $start = $this->items[$index]['start_time'] ?? null;
        $end   = $this->items[$index]['end_time'] ?? null;

        if ($start && $end) {
            $duration = (strtotime($end) - strtotime($start)) / 3600;
            $duration = max($duration, 0);
            $this->items[$index]['duration_hours'] = number_format($duration, 2, '.', '');
        }
    }

    public function generateKodeSpl()
    {
        $date = now()->format('Ymd');
        $rand = Str::upper(Str::random(4));
        $baseCode = "SPL-$date-$rand";

        $count = Spl::where('kode_spl', 'like', "$baseCode%")->count();

        if ($count > 0) {
            $counter = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
            $this->kode_spl = "$baseCode-$counter";
        } else {
            $this->kode_spl = $baseCode;
        }
    }

    /** =========================
     *        EDIT MODE
     * ========================= */
    public function loadEdit($id)
    {
        $this->resetForm();

        $spl = Spl::with('splItems')->find($id);

        $this->editingId     = $spl->id;
        $this->kode_spl      = $spl->kode_spl;
        $this->department_id = $spl->department_id;
        $this->section_id    = $spl->section_id;
        $this->notes         = $spl->notes;

        $this->sections = Section::where('department_id', $this->department_id)->get();
        $this->user     = User::where('section_id', $this->section_id)->get();

        $this->items = $spl->splItems->toArray();

        $this->dispatch('showCreateModal');
    }

    /** =========================
     *        SAVE NEW
     * ========================= */
    public function save()
    {
        DB::transaction(function () {
            $spl = Spl::create([
                'kode_spl'      => $this->kode_spl,
                'department_id' => $this->department_id,
                'section_id'    => $this->section_id,
                'notes'         => $this->notes,
                'status'        => 'Approved',
            ]);

            foreach ($this->items as $row) {
                $spl->splItems()->create([
                    'user_id'        => $row['user_id'],
                    'date'           => $row['date'],
                    'start_time'     => $row['start_time'],
                    'end_time'       => $row['end_time'],
                    'duration_hours' => $row['duration_hours'],
                ]);
            }
        });

        session()->flash('success', 'SPL berhasil disimpan!');

        $this->dispatch('hideCreateModal');
        $this->dispatch('refreshTable');
        $this->resetForm();
    }

    /** =========================
     *           UPDATE
     * ========================= */
    public function update()
    {
        DB::transaction(function () {

            $spl = Spl::find($this->editingId);

            // Update header
            $spl->update([
                'department_id' => $this->department_id,
                'section_id'    => $this->section_id,
                'notes'         => $this->notes,
            ]);

            // Hapus item lama
            SplItem::where('spl_id', $spl->id)->delete();

            // Insert item baru
            foreach ($this->items as $row) {
                $spl->splItems()->create([
                    'user_id'        => $row['user_id'],
                    'date'           => $row['date'],
                    'start_time'     => $row['start_time'],
                    'end_time'       => $row['end_time'],
                    'duration_hours' => $row['duration_hours'],
                ]);
            }
        });

        session()->flash('success', 'SPL berhasil diperbarui!');
        $this->dispatch('hideCreateModal');
        $this->dispatch('refreshTable');
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.manager.spl.create', [
            'departments' => Department::orderBy('name')->get(),
        ]);
    }
}
