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
                                    <th>Kode SPL</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($splItems as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->spl->kode_spl?? '-' }}</td>
                                        <td>{{ $item->user->name ?? '-' }}</td>
                                        <td>{{ $item->date }}</td>

                                        <td>
                                            @php 
                                                $status = $item->status; 
                                            @endphp
                                            <span class="badge 
                                                {{ $status == 'Approved' ? 'badge-success' : '' }}
                                                {{ $status == 'Pending' ? 'badge-warning' : '' }}
                                                {{ $status == 'Rejected' ? 'badge-danger' : '' }}
                                            ">
                                                {{ $status }}
                                            </span>
                                        </td>

                                        <td>
                                            {{-- VERIFICATION --}}
                                            <button 
                                                class="btn btn-sm btn-warning"
                                                wire:click="$dispatch('showModalVerification', {{ $item->id }})">
                                                <i class="fas fa-edit"></i>
                                                Verification
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
        @livewire('admin.approval.verification') 

    </div>
</div>
