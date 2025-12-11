<div wire:ignore.self class="modal fade" id="modalVerification" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Verifikasi SPL Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select wire:model="status" class="form-control">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                {{-- JENIS LEMBUR --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Lembur</label>
                    <select wire:model.live="overtime_type" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Off">Off</option>
                    </select>
                </div>

                {{-- DURASI --}}
                <div class="mb-3">
                    <label class="form-label">Durasi (jam)</label>
                    <input type="number" class="form-control" min="0" wire:model.live="duration_hours">
                </div>

                {{-- HASIL --}}
                <div class="mb-3">
                    <label class="form-label">Total Konversi</label>
                    <input type="text" class="form-control" wire:model="total_conversion" readonly>
                </div>

                {{-- CATATAN --}}
                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea class="form-control" wire:model="notes"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                <button class="btn btn-primary" wire:click="save">
                    Simpan Perubahan
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    window.addEventListener('showModalVerification', () => {
        var modal = new bootstrap.Modal(document.getElementById('modalVerification'));
        modal.show();
    });

    window.addEventListener('hideModalVerification', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalVerification'));
        if (modal) modal.hide();
    });
</script>
