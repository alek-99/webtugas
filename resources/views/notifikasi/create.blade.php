<x-app-layout>

{{-- @section('content') --}}
<div class="container py-4">
    <div class="row">
        <!-- Form Buat Notifikasi -->
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Notifikasi WhatsApp
                    </h5>
                </div>
                <div class="card-body">
                    <form id="formNotifikasi">
                        @csrf
                        
                        <!-- Pilih Tugas -->
                        <div class="mb-3">
                            <label for="tugas_id" class="form-label">
                                <i class="fas fa-tasks text-primary"></i> Pilih Tugas
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="tugas_id" name="tugas_id" required>
                                <option value="">-- Pilih Tugas --</option>
                                @foreach($tugas as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul_tugas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div class="mb-3">
                            <label for="target_number" class="form-label">
                                <i class="fab fa-whatsapp text-success"></i> Nomor WhatsApp
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="target_number" 
                                name="target_number"
                                placeholder="62812345678"
                                required
                            >
                            <small class="text-muted">Format: 62812345678 (gunakan kode negara)</small>
                        </div>

                        <!-- Pesan -->
                        <div class="mb-3">
                            <label for="message" class="form-label">
                                <i class="fas fa-comment-dots text-info"></i> Pesan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control" 
                                id="message" 
                                name="message"
                                rows="4"
                                placeholder="Tulis pesan Anda di sini..."
                                required
                            ></textarea>
                            <small class="text-muted">
                                <span id="charCount">0</span> karakter
                            </small>
                        </div>

                        <!-- Tipe Pengiriman -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-clock text-warning"></i> Waktu Pengiriman
                                <span class="text-danger">*</span>
                            </label>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="send_type" 
                                    id="send_now"
                                    value="now"
                                    checked
                                >
                                <label class="form-check-label" for="send_now">
                                    Kirim Sekarang
                                </label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="send_type" 
                                    id="send_scheduled"
                                    value="scheduled"
                                >
                                <label class="form-check-label" for="send_scheduled">
                                    Jadwalkan Pengiriman
                                </label>
                            </div>
                        </div>

                        <!-- Input Tanggal & Waktu (Hidden by default) -->
                        <div class="mb-3" id="scheduledDateGroup" style="display: none;">
                            <label for="scheduled_at" class="form-label">
                                <i class="fas fa-calendar-alt text-danger"></i> Tanggal & Waktu Kirim
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                class="form-control" 
                                id="scheduled_at" 
                                name="scheduled_at"
                            >
                            <small class="text-muted">Pilih kapan notifikasi akan dikirim</small>
                        </div>

                        <!-- Alert -->
                        <div id="alertContainer"></div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">
                                <i class="fas fa-paper-plane me-2"></i>
                                <span id="btnText">Kirim Notifikasi</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Notifikasi -->
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Riwayat Notifikasi
                    </h5>
                </div>
                <div class="card-body">
                    @if($notifikasi->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada notifikasi</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Tugas</th>
                                        <th>Nomor</th>
                                        <th>Jadwal</th>
                                        <th width="15%">Status</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="notifikasiTable">
                                    @foreach($notifikasi as $index => $notif)
                                    <tr data-id="{{ $notif->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $notif->tugas->judul_tugas ?? '-' }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit($notif->message, 40) }}
                                            </small>
                                        </td>
                                        <td>
                                            <i class="fab fa-whatsapp text-success"></i>
                                            {{ $notif->target_number }}
                                        </td>
                                        <td>
                                            @if($notif->scheduled_at)
                                                <i class="fas fa-clock text-warning"></i>
                                                {{ $notif->scheduled_at->format('d/m/Y H:i') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($notif->status === 'sent')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Terkirim
                                                </span>
                                            @elseif($notif->status === 'scheduled')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock"></i> Terjadwal
                                                </span>
                                            @elseif($notif->status === 'pending')
                                                <span class="badge bg-info">
                                                    <i class="fas fa-spinner"></i> Pending
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle"></i> Gagal
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($notif->status === 'scheduled')
                                                <button 
                                                    class="btn btn-sm btn-danger btnDelete" 
                                                    data-id="{{ $notif->id }}"
                                                    title="Hapus Jadwal"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
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
    </div>
</div>

{{-- @endsection --}}

{{-- @push('styles') --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
{{-- @endpush --}}

{{-- @push('scripts') --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formNotifikasi');
    const sendNowRadio = document.getElementById('send_now');
    const sendScheduledRadio = document.getElementById('send_scheduled');
    const scheduledDateGroup = document.getElementById('scheduledDateGroup');
    const scheduledAtInput = document.getElementById('scheduled_at');
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const btnText = document.getElementById('btnText');
    const alertContainer = document.getElementById('alertContainer');

    // Set minimum datetime untuk input
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    scheduledAtInput.min = now.toISOString().slice(0, 16);

    // Toggle scheduled date input
    sendNowRadio.addEventListener('change', function() {
        if (this.checked) {
            scheduledDateGroup.style.display = 'none';
            scheduledAtInput.removeAttribute('required');
            btnText.textContent = 'Kirim Notifikasi';
        }
    });

    sendScheduledRadio.addEventListener('change', function() {
        if (this.checked) {
            scheduledDateGroup.style.display = 'block';
            scheduledAtInput.setAttribute('required', 'required');
            btnText.textContent = 'Jadwalkan Notifikasi';
        }
    });

    // Character counter
    messageTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Submit form
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        const btnSubmit = document.getElementById('btnSubmit');
        
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        
        try {
            const response = await fetch('{{ route("notifikasi.send") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                showAlert('success', result.message || 'Notifikasi berhasil diproses');
                form.reset();
                charCount.textContent = '0';
                scheduledDateGroup.style.display = 'none';
                
                // Reload halaman setelah 1.5 detik
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showAlert('danger', result.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            showAlert('danger', 'Terjadi kesalahan saat mengirim notifikasi');
            console.error(error);
        } finally {
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = '<i class="fas fa-paper-plane me-2"></i><span id="btnText">Kirim Notifikasi</span>';
        }
    });

    // Delete scheduled notification
    document.addEventListener('click', async function(e) {
        if (e.target.closest('.btnDelete')) {
            const btn = e.target.closest('.btnDelete');
            const id = btn.dataset.id;

            if (!confirm('Yakin ingin menghapus notifikasi terjadwal ini?')) {
                return;
            }

            try {
                const response = await fetch(`/notifikasi/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showAlert('success', result.message);
                    // Hapus baris dari tabel
                    btn.closest('tr').remove();
                } else {
                    showAlert('danger', result.message);
                }
            } catch (error) {
                showAlert('danger', 'Terjadi kesalahan saat menghapus');
                console.error(error);
            }
        }
    });

    function showAlert(type, message) {
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        setTimeout(() => {
            alertContainer.innerHTML = '';
        }, 5000);
    }
});
</script>
{{-- @endpush --}}
</x-app-layout>

