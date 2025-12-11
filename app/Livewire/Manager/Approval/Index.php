<?php

namespace App\Livewire\Manager\Approval;

use App\Models\Spl;;

use App\Models\SplItem;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $title = "Surat Perintah Lembur";

    public $search = '';
    public $perPage = 10;
    public $deleteId = null;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        SplItem::where('spl_id', $this->deleteId)->delete();
        Spl::find($this->deleteId)->delete();

        $this->deleteId = null;

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('refreshTable');
    }

    public function setStatus($id, $status)
    {
        $spl = Spl::find($id);

        if (!$spl) return;

        $spl->update([
            'status' => $status
        ]);

        session()->flash('success', "Status berhasil diubah menjadi {$status}.");
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        $spls = Spl::with(['department', 'section'])
            ->when($this->search, function ($query) {
                $query->where('nomor_spl', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.manager.approval.index', [
            'title' => 'Data Surat Perintah Lembur (SPL)',
            'spls'  => $spls,
        ]);
    }
}
