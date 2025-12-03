@component('mail::message')
# Pengingat Tugas 📚

Halo {{ $reminder->user->name }},

Jangan lupa kamu punya pengingat:
**{{ $reminder->judul }}**

@if($reminder->tugas)
Terkait dengan tugas: **{{ $reminder->tugas->judul_tugas }}**
@endif

📅 Waktu Pengingat: {{ \Carbon\Carbon::parse($reminder->reminder_at)->format('d M Y H:i') }}

{{ $reminder->deskripsi }}

Terima kasih,  
{{ config('app.name') }}
@endcomponent
