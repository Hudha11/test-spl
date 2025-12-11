<?php

namespace App\Livewire\Admin\Approval;

use Livewire\Component;
use App\Models\SplItem;

class Verification extends Component
{
    public $itemId;
    public $status;
    public $notes;

    public $overtime_type;
    public $duration_hours;
    public $total_conversion = 0;

    protected $listeners = [
        'showModalVerification' => 'loadData',
        'refreshTable' => '$refresh',
    ];

    public function loadData($id)
    {
        $this->resetValidation();
        $this->resetForm();

        $this->itemId = $id;

        $item = SplItem::with(['user', 'spl'])->find($id);

        if ($item) {
            $this->status           = $item->status;
            $this->notes            = $item->notes;
            $this->overtime_type    = $item->overtime_type;
            $this->duration_hours   = $item->duration_hours;
            $this->hitung();
        }

        $this->dispatch('showModalVerification');
    }

    public function updatedOvertimeType()
    {
        $this->hitung();
    }

    public function updatedDurationHours()
    {
        $this->hitung();
    }

    public function hitung()
    {
        if (!$this->overtime_type || $this->duration_hours <= 0) {
            $this->total_conversion = 0;
            return;
        }

        $jam = intval($this->duration_hours);
        $total = 0;

        // LEMBUR REGULER
        if ($this->overtime_type === 'Reguler') {

            if ($jam >= 1) {
                $total += 1.5;
                $jam -= 1;
            }

            if ($jam > 0) {
                $total += ($jam * 2);
            }
        }

        // LEMBUR OFF
        elseif ($this->overtime_type === 'Off') {

            if ($jam <= 1) {
                $this->total_conversion = 0;
                return;
            }

            $jam -= 1;

            $jam_2x = min($jam, 7);
            $total += $jam_2x * 2;
            $jam -= $jam_2x;

            if ($jam > 0) {
                $total += 3;
                $jam -= 1;
            }

            if ($jam > 0) {
                $total += $jam * 4;
            }
        }

        $this->total_conversion = $total;
    }

    public function save()
    {
        $this->validate([
            'status' => 'required',
            'notes' => 'nullable|string',
            'overtime_type' => 'required',
            'duration_hours' => 'required|numeric|min:0',
        ]);

        $item = SplItem::find($this->itemId);

        if ($item) {
            $item->status           = $this->status;
            $item->notes            = $this->notes;
            $item->overtime_type    = $this->overtime_type;
            $item->duration_hours   = $this->duration_hours;
            $item->total_conversion = $this->total_conversion;
            $item->save();
        }

        session()->flash('success', 'Data berhasil diperbarui');

        $this->dispatch('hideModalVerification');
        $this->dispatch('refreshTable');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->status = null;
        $this->notes = null;
        $this->overtime_type = null;
        $this->duration_hours = 0;
        $this->total_conversion = 0;
    }

    public function render()
    {
        return view('livewire.admin.approval.verification');
    }
}
