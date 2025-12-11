<?php

namespace App\Livewire\Admin\Approval;

use Livewire\WithPagination;
use App\Models\SplItem;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $title = 'Data Verifikasi Approval SPL';
    public $search = '';
    public $perPage = 10;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $splItems = SplItem::with(['spl', 'user'])
            ->when($this->search, function ($query) {
                $search = $this->search;

                $query->whereHas('spl', function ($q) use ($search) {
                    $q->where('kode_spl', 'like', "%{$search}%");
                })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->paginate($this->perPage);

        return view('livewire.admin.approval.index', [
            'title' => $this->title,
            'splItems' => $splItems,
        ]);
    }
}
