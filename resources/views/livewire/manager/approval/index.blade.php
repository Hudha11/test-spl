<div>
    <div class="content-wrapper">

        {{-- Page Header --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="content">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($spls as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_spl }}</td>
                                        <td>{{ $item->department->name ?? '-' }}</td>
                                        <td>{{ $item->section->name ?? '-' }}</td>
                                        <td>{{ $item->notes }}</td>

                                        <td>
                                            @php $status = $item->status; @endphp
                                            <span class="badge 
                                                {{ $status == 'Approved' ? 'badge-success' : '' }}
                                                {{ $status == 'Pending' ? 'badge-warning' : '' }}
                                                {{ $status == 'Rejected' ? 'badge-danger' : '' }}
                                            ">
                                                {{ $status }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    Aksi
                                                </button>

                                                <div class="dropdown-menu" role="menu">

                                                    <a class="dropdown-item"
                                                    href="#"
                                                    wire:click="setStatus({{ $item->id }}, 'Pending')">
                                                        <i class="fas fa-clock text-warning mr-2"></i> Pending
                                                    </a>
                                                    <a class="dropdown-item"
                                                    href="#"
                                                    wire:click="setStatus({{ $item->id }}, 'Approved')">
                                                        <i class="fas fa-check text-success mr-2"></i> Approved
                                                    </a>

                                                    <a class="dropdown-item"
                                                    href="#"
                                                    wire:click="setStatus({{ $item->id }}, 'Rejected')">
                                                        <i class="fas fa-times text-danger mr-2"></i> Rejected
                                                    </a>

                                                </div>
                                            </div>

                                            {{-- EDIT --}}
                                            {{-- <button 
                                                class="btn btn-sm btn-warning"
                                                wire:click="$dispatch('openSplForm', { id: {{ $item->id }} })">
                                                <i class="fas fa-edit"></i>
                                            </button> --}}

                                            {{-- DELETE --}}
                                            <button 
                                                class="btn btn-sm btn-danger"
                                                wire:click="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </section>

        {{-- Include Modal Create/Edit (Livewire Component) --}}
        <div>
            @livewire('manager.spl.create')
        </div>

        {{-- Delete Confirmation Modal --}}
        @if ($deleteId)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,.5)">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="close" wire:click="$set('deleteId', null)">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>

                        <div class="modal-footer">
                            <button wire:click="delete" class="btn btn-danger">Hapus</button>
                            <button wire:click="$set('deleteId', null)" class="btn btn-secondary">Batal</button>
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
