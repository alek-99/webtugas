<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow bg-white text-dark dark:bg-gray-800 dark:text-gray-200">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Mata Kuliah</label>
                            <input type="text" name="kode_matkul" id="editKode" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mata Kuliah</label>
                            <input type="text" name="nama_matkul" id="editNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dosen</label>
                            <input type="text" name="dosen" id="editDosen" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SKS</label>
                            <input type="number" name="sks" id="editSks" min="1" max="6" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>