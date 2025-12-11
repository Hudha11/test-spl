<div>
  <!-- Modal Create SPL -->
  <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <h5 class="modal-title">{{ $editingId ? 'Update' : 'Tambah' }} {{ $title }}</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <!-- Body -->
        <div class="modal-body">

          <h5 class="mb-2 font-weight-bold">Informasi SPL</h5>
          <hr>

          <!-- Kode SPL -->
          <div class="form-group">
            <label>Kode SPL</label>
            <input type="text" class="form-control" wire:model="kode_spl" readonly>
          </div>

          <!-- Department -->
          <div class="form-group">
            <label>Department</label>
            <select class="form-control" wire:model.live="department_id">
              <option value="">-- Pilih Department --</option>
              @foreach ($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- Section -->
          <div class="form-group">
            <label>Section</label>
            <select class="form-control" wire:model.live="section_id" @disabled(!$department_id)>
              <option value="">-- Pilih Section --</option>
              @foreach ($sections as $sec)
                <option value="{{ $sec->id }}">{{ $sec->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- Notes -->
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" rows="3" wire:model="notes"></textarea>
          </div>

          <hr>

          <h5 class="mt-2 mb-2 font-weight-bold">Daftar Anggota Lembur</h5>

          @if($department_id && $section_id)
            <button class="btn btn-success btn-sm mb-2" wire:click="addItem">
              + Tambah Anggota Lembur
            </button>
          @endif

          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead class="thead-light">
                <tr>
                  <th>Nama Karyawan</th>
                  <th>Tanggal</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Durasi (Jam)</th>
                  <th width="60">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($items as $index => $row)
                  <tr wire:key="item-row-{{ $index }}">
                    <td>
                      <select class="form-control form-control-sm" wire:model.live="items.{{ $index }}.user_id">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($user as $emp)
                          <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                      </select>
                    </td>

                    <td>
                      <input type="date" class="form-control form-control-sm"
                            wire:model.live="items.{{ $index }}.date">
                    </td>

                    <td>
                      <input type="time" class="form-control form-control-sm"
                            wire:model.live="items.{{ $index }}.start_time">
                    </td>

                    <td>
                      <input type="time" class="form-control form-control-sm"
                            wire:model.live="items.{{ $index }}.end_time">
                    </td>

                    <td>
                      <input type="text" class="form-control form-control-sm text-center"
                            wire:model="items.{{ $index }}.duration_hours" readonly>
                    </td>

                    <td class="text-center">
                      <button class="btn btn-danger btn-sm" wire:click="removeItem({{ $index }})">
                        Hapus
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted">
                      Belum ada anggota lembur
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" wire:click="{{ $editingId ? 'update' : 'save' }}"> {{ $editingId ? 'Update' : 'Simpan' }}</button>
        </div>

      </div>
    </div>
  </div>

  <!-- SCRIPT BOOTSTRAP 4 -->
  <script>
      // Buka Modal
      window.addEventListener('showCreateModal', () => {
          $('#createModal').modal('show');
      });

      // Tutup Modal
      window.addEventListener('hideCreateModal', () => {
          $('#createModal').modal('hide');
      });

      // Notifikasi sukses
      window.addEventListener('alertSuccess', (event) => {
          Swal.fire({
              icon: 'success',
              title: event.detail.message,
              timer: 1500,
              showConfirmButton: false
          });
      });
  </script>
</div>