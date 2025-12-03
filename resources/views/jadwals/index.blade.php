<x-app-layout>
    @section('title','Manajemen Jadwal')
{{-- statistik jadwal per hari --}}
<div class="container py-2">
    <div class="text-center mb-3">
        <h3 class="fw-bold text-primary">Statistik Jadwal Per Hari</h3>
        <p class="text-muted small">Rekap jumlah jadwal kuliah berdasarkan hari.</p>
    </div>
<div class="row g-3">
 
    @foreach ($jadwalPerHari as $hari => $jumlah)
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card shadow-sm border-0 text-center p-3 bg-primary text-white">
                <h6 class="fw-bold mb-1">{{ $hari }}</h6>
                <h4 class="fw-semibold mb-0">{{ $jumlah }}</h4>
            </div>
        </div>
    @endforeach
</div>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 mt-8 bg-blue-600 shadow-lg p-4 text-white">
        <div>
            <h2 class="fw-semibold mb-0">Daftar Jadwal Kuliah</h2>
            <p class=" small mb-0">Untuk Membuat Jadwal Silahkan Buat Mata Kuliah Terlebih Dahulu Ya Bestieee!!!!</p>
            <span class=" small mb-2">NOTE : Jika Data Mata kuliah terhapus Maka Jadwal Mata kuliah tersebut Akan ikut Terhapus</span>
        </div>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Jadwal
        </button>
    </div>

    <!-- Table -->
    <div class="table-responsive bg-white shadow-sm">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-light text-secondary text-uppercase small">
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Mata Kuliah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td>{{ $jadwal->ruang }}</td>
                    <td>{{ $jadwal->mata_kuliah->nama_matkul ?? '-' }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $jadwal->id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus jadwal ini?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal-{{ $jadwal->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $jadwal->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content rounded-4 border-0 shadow bg-white text-dark">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editModalLabel{{ $jadwal->id }}">Edit Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('jadwals.update', $jadwal->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="">Pilih Hari</option>
                            @foreach (['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                                <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Jam Mulai</label>
                           <input type="time" name="jam_mulai"
       value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}"
       required class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai"
       value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}"
       required class="form-control">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Ruang</label>
                        <input type="text" name="ruang" value="{{ $jadwal->ruang }}" required class="form-control">
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mata_kuliah_id" class="form-select" required>
                            @foreach ($mataKuliahs as $mk)
                                <option value="{{ $mk->id }}" {{ $jadwal->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                                    {{ $mk->nama_matkul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer flex-column flex-md-row gap-2">
                    <button type="button" class="btn btn-secondary w-100 w-md-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary w-100 w-md-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow bg-white text-dark dark:bg-gray-800 dark:text-gray-200">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="addModalLabel">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('jadwals.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                       <select name="hari" id="hari" class="form-select" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jum'at</option>
                    </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" required class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" required class="form-control">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Ruang</label>
                        <input type="text" name="ruang" required class="form-control">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mata_kuliah_id" required class="form-select">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $mk)
                                <option value="{{ $mk->id }}">{{ $mk->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
