<x-app-layout>
    @section('title','Manajemen Tugas')
{{-- Statistik Tugas --}}
<div class="container my-2">
  <div class="row g-2 justify-content-center">

    <!-- Total Tugas -->
    <div class="col-16 col-md-4">
      <div class="card border-0 shadow text-white" style="background:#2563eb;">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
          <div>
            <h6 class="text-uppercase fw-semibold text-white-50 mb-1">Total Tugas</h6>
            <h2 class="fw-bold mb-0">{{ $totalTugas }}</h2>
          </div>
          <i class="bi bi-clipboard-check fs-1 opacity-25"></i>
        </div>
      </div>
    </div>

    <!-- Tugas Selesai -->
    <div class="col-16 col-md-4">
      <div class="card border-0 shadow  text-white" style="background:#059669;">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
          <div>
            <h6 class="text-uppercase fw-semibold text-white-50 mb-1">Tugas Selesai</h6>
            <h2 class="fw-bold mb-0">{{ $tugasSelesai }}</h2>
          </div>
          <i class="bi bi-check-circle fs-1 opacity-25"></i>
        </div>
      </div>
    </div>

    <!-- Tugas Belum Dikerjakan -->
    <div class="col-16 col-md-4">
      <div class="card border-0 shadow text-white" style="background:#dc2626;">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
          <div>
            <h6 class="text-uppercase fw-semibold text-white-50 mb-1">Belum Dikerjakan</h6>
            <h2 class="fw-bold mb-0">{{ $tugasBelum }}</h2>
          </div>
          <i class="bi bi-hourglass-split fs-1 opacity-25"></i>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Daftar Tugas -->
<div class="container-fluid px-3 px-md-2 py-2">
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 mt-8 bg-white shadow-lg p-4 text-dark">
    <div>
      <h4 class="fw-semibold text-primary mb-1 text-center text-md-start">
        Daftar Tugas
      </h4>
      <p class="text-center mb-2">
        Atur dan kelola tugas Anda agar efisien dan tidak lupa 😊
      </p>
      <span class="text-center text-red-600 ">NOTE : Jangan Hapus Data Mata Kuliah ya Bestie Karena Jika Data Mata Kuliah Terhapus Maka Data Tugas Dari Mata Kuliah Tersebut Oge Milu KaHapus!!!
        HATI HATI YA BESTIE!!!
      </span>
    </div>

    <!-- Tombol Tambah -->
    <div class="text-center text-md-end">
      <button 
        type="button"
        class="btn btn-primary px-4 py-2 fw-semibold rounded-3 shadow-sm"
        data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
      </button>
    </div>
  </div>


</div>



    <!-- TABLE -->
    <div class="table-responsive shadow-sm">
        <table class="table table-striped align-middle text-center w-100 mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Mata Kuliah</th>
                    <th>Judul Tugas</th>
                    <th>Deadline</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>File Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mataKuliah->nama_matkul ?? '-' }}</td>
                    <td>{{ $item->judul_tugas }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <span class="badge 
                            @if($item->status == 'belum dikerjakan') bg-warning text-dark
                            @else bg-success
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        @if($item->file_lampiran)
                            <a href="{{ asset('storage/' . $item->file_lampiran) }}" 
                               class="btn btn-sm btn-outline-info"
                               target="_blank">
                               <i class="bi bi-paperclip"></i> Lihat File
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                       <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
        <!-- Tombol Edit -->
        <button class="btn btn-sm btn-outline-primary"
                data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
            <i class="bi bi-pencil-square"></i>
        </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('tugass.destroy', $item->id) }}" method="POST" class="delete-form m-0">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                <i class="bi bi-trash3"></i>
            </button>
        </form>
    </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow bg-white text-dark dark:bg-gray-800 dark:text-gray-200">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Edit Tugas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tugass.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <!-- Mata Kuliah (hanya tampil, tidak bisa diedit) -->
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah</label>
                        <input type="text" value="{{ $item->mataKuliah->nama_matkul ?? '-' }}" 
                            class="form-control" readonly>
                    </div>

                    <!-- Judul Tugas (hanya tampil, tidak bisa diedit) -->
                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" value="{{ $item->judul_tugas }}" 
                            class="form-control" readonly>
                    </div>

                    <!-- Deskripsi (hanya tampil, tidak bisa diedit) -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3" readonly>{{ $item->deskripsi }}</textarea>
                    </div>

                    <!-- Status (boleh diedit) -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="belum dikerjakan" {{ $item->status == 'belum dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                            <option value="dikerjakan" {{ $item->status == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                        </select>
                    </div>

                    <!-- Deadline (boleh diedit) -->
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" value="{{ $item->deadline }}" 
                            class="form-control" required>
                    </div>

                    <!-- File Lampiran (boleh diubah) -->
                    <div class="mb-3">
                        <label class="form-label">File Lampiran</label>
                        @if($item->file_lampiran)
                            <div class="p-2 border rounded bg-light d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    {{ basename($item->file_lampiran) }}
                                </span>
                                <a href="{{ asset('storage/' . $item->file_lampiran) }}" 
                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                   Lihat
                                </a>
                            </div>
                        @else
                            <input type="text" value="Tidak ada file" class="form-control" readonly>
                        @endif
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada tugas yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow bg-white text-dark dark:bg-gray-800 dark:text-gray-200">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Tambah Tugas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tugass.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mata_kuliah_id" class="form-select" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach(\App\Models\MataKuliah::where('user_id', Auth::id())->get() as $mk)
                                <option value="{{ $mk->id }}">{{ $mk->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" name="judul_tugas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="belum dikerjakan">Belum Dikerjakan</option>
                            <option value="dikerjakan">Dikerjakan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran (opsional)</label>
                        <input type="file" name="file_lampiran" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert -->
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif

<!-- Konfirmasi Hapus -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tugas akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>
