<x-app-layout>
@section('title','Manajemen Mata Kuliah')

   <!-- Kartu Statistik Mata Kuliah -->
<div class="container my-2">
  <div class="row g-4 justify-content-center">

    <!-- TOTAL MATAKULIAH -->
    <div class="col-12 col-md-6 col-lg-5">
      <div class="card border-0 shadow-lg  overflow-hidden position-relative"
           style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: #fff;">
        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">
          <i class="bi bi-journal-bookmark-fill display-1"></i>
        </div>
        <div class="card-body py-4 px-5 d-flex flex-column justify-content-between">
          <h6 class="text-uppercase fw-semibold mb-2 opacity-75">Total Mata Kuliah</h6>
          <h1 class="fw-bold display-5 mb-0">{{ $totalMk }}</h1>
          <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
            <div class="progress-bar bg-white" style="width: 80%;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- TOTAL SKS -->
    <div class="col-12 col-md-6 col-lg-5">
      <div class="card border-0 shadow-lg  overflow-hidden position-relative"
           style="background: linear-gradient(135deg, #065f46, #10b981); color: #fff;">
        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">
          <i class="bi bi-book-half display-1"></i>
        </div>
        <div class="card-body py-4 px-5 d-flex flex-column justify-content-between">
          <h6 class="text-uppercase fw-semibold mb-2 opacity-75">Total SKS</h6>
          <h1 class="fw-bold display-5 mb-0">{{ $totalSKS }}</h1>
          <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
            <div class="progress-bar bg-white" style="width: 65%;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

    <div class="container py-5">
        {{-- Header + Button Tambah --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2 mt-2 p-3 bg-white shadow-sm border-0">
    <div class="d-flex flex-column">
        <h3 class="fw-bold mb-1 text-primary text-center">Daftar Mata Kuliah</h3>
        <p class="text-muted small mb-0">Kelola daftar mata kuliah Anda untuk perencanaan tugas dan jadwal kuliah.</p>
    </div>
    <button class="btn btn-primary px-4 py-2 rounded-3 fw-semibold shadow-sm hover-animate" 
            data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-2"></i> Tambah Mata Kuliah
    </button>
</div>

<!-- Efek animasi & interaksi -->
<style>
.hover-animate {
  transition: all 0.25s ease;
}
.hover-animate:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 123, 255, 0.25);
}

.text-primary {
  color: #2563eb !important; /* Warna biru lebih modern (Tailwind-style) */
}

.bg-white {
  background-color: #fff !important;
}

@media (max-width: 768px) {
  .btn {
    width: 100%;
  }
}
</style>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="card border-0 shadow-sm ">
            <div class="card-body p-0">
                @if($mataKuliahs->isEmpty())
                    <p class="text-center text-muted py-4 mb-0">Belum ada mata kuliah. Tambahkan data baru.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Dosen</th>
                                    <th>SKS</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mataKuliahs as $mataKuliah)
                                    <tr>
                                        <td>{{ $mataKuliah->kode_matkul }}</td>
                                        <td>{{ $mataKuliah->nama_matkul }}</td>
                                        <td>{{ $mataKuliah->dosen ?? '-' }}</td>
                                        <td>{{ $mataKuliah->sks }}</td>
                                        <td class="text-end">
                                            <button 
                                                class="btn btn-sm btn-outline-primary me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $mataKuliah->id }}"
                                                data-kode="{{ $mataKuliah->kode_matkul }}"
                                                data-nama="{{ $mataKuliah->nama_matkul }}"
                                                data-dosen="{{ $mataKuliah->dosen }}"
                                                data-sks="{{ $mataKuliah->sks }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <form action="{{ route('matakuliahs.destroy', $mataKuliah) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
   @include('layouts.partials.addmodal')

    {{-- Modal Edit --}}
    @include('layouts.partials.editmodal')

    {{-- Script untuk Modal Edit --}}
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');
            const nama = button.getAttribute('data-nama');
            const dosen = button.getAttribute('data-dosen');
            const sks = button.getAttribute('data-sks');

            document.getElementById('editKode').value = kode;
            document.getElementById('editNama').value = nama;
            document.getElementById('editDosen').value = dosen;
            document.getElementById('editSks').value = sks;
            document.getElementById('editForm').action = `/matakuliahs/${id}`;
        });
    </script>

    {{-- SweetAlert Notification --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    </script>
   
</x-app-layout>
