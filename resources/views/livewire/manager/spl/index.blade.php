<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger modal -->
                    <button wire:click="$dispatch('openSplForm')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus mr-1"></i>
                        Tambah Data
                    </button>
                </div>
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
                                        <td>{{ $item->department->name?? '-' }}</td>
                                        <td>{{ $item->section->name?? '-' }}</td>
                                        <td>{{ $item->notes }}</td>
                                        @php
                                            $status = $item->status;
                                        @endphp

                                        <td>
                                            <span class="badge 
                                                {{ $status == 'Approved' ? 'badge-success' : '' }}
                                                {{ $status == 'Pending' ? 'badge-warning' : '' }}
                                                {{ $status == 'Rejected' ? 'badge-danger' : '' }}
                                            ">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
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

        {{-- Include Mmodal --}}
        {{-- @include('livewire.manager.spl.create') salah --}}
        @livewire('manager.spl.create')
        {{-- Include Mmodal --}}

    </div>
</div>