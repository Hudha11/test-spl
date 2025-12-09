<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          {{-- KODE SPL --}}
          <div class="form-group">
              <label>Kode SPL</label>
              <input wire:model="kode_spl" type="text" class="form-control" readonly>
          </div>

          {{-- Department --}}
          <div class="form-group">
              <label>Department</label>
              <select wire:model.live="department_id" class="form-control">
                  <option value="">-- Pilih Department --</option>
                  @foreach ($departments as $dept)
                      <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                  @endforeach
              </select>
              @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Section --}}
          <div class="form-group">
              <label>Section</label>
              <select wire:model="section_id" class="form-control" @disabled(!$department_id)>
                  <option value="">-- Pilih Section --</option>
                  @foreach ($sections as $sec)
                      <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                  @endforeach
              </select>
              @error('section_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Notes --}}
          <div class="form-group">
              <label>Notes</label>
              <textarea wire:model="notes" class="form-control" rows="3"></textarea>
              @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button wire:click="save" type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>