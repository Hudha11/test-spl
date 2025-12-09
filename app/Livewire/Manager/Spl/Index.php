<?php

namespace App\Livewire\Manager\Spl;

use App\Models\Spl;
use Livewire\Component;

class Index extends Component
{
    public $deleteId;

    protected $listeners = ['refreshSplTable' => '$refresh'];

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        spl::findOrFail($this->deleteId)->delete();
        $this->dispatch('refreshDatatable');
        $this->dispatchBrowserEvent('showAlert', ['type' => 'success', 'message' => 'Data berhasil dihapus!']);
    }

    public function render()
    {
        $data = array(
            'title' => 'Data Surat Perintah Lembur (SPL)',
            'spls' => Spl::with(['department', 'section'])->get()
        );
        return view('livewire.manager.spl.index', $data);
    }
}
