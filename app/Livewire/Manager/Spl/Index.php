<?php

namespace App\Livewire\Manager\Spl;

use App\Models\Spl;
use App\Models\SplItem;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

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

    public function render()
    {
        $spls = Spl::with(['department', 'section'])
            ->when($this->search, function ($query) {
                $query->where('nomor_spl', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.manager.spl.index', [
            'title' => 'Data Surat Perintah Lembur (SPL)',
            'spls'  => $spls,
        ]);
    }
}
