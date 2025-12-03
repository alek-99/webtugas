<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\TugasReminderMail;

Artisan::command('inspire', function () {
    $this->comment(\Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('reminder:tugas', function () {
    $now = Carbon::now();

    // Ambil tugas yang deadlinenya H-1 dan belum dikerjakan
    $tugas = Tugas::where('status', '!=', 'selesai')
        ->whereDate('deadline', '=', $now->addDay()->toDateString())
        ->with('user')
        ->get();

    foreach ($tugas as $t) {
        $user = $t->user;

        if ($user && $user->email) {
            Mail::to($user->email)->send(new TugasReminderMail($t));
        }

        Log::info("Reminder dikirim ke {$user->email} untuk tugas {$t->judul_tugas}");
    }

    $this->info('Reminder tugas berhasil dikirim!');
})->purpose('Mengirim pengingat tugas otomatis');
