<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Notifikasi;
use Illuminate\Console\Command;
use App\Services\FonteNotifikasiService;

class SendScheduledNotifications extends Command
{
    protected $signature = 'notifications:send-scheduled';
    protected $description = 'Kirim notifikasi yang sudah waktunya';

    protected $fonnte;

    public function __construct(FonteNotifikasiService $fonnte)
    {
        parent::__construct();
        $this->fonnte = $fonnte;
    }

    public function handle()
    {
        $now = Carbon::now();

        // Ambil notifikasi yang sudah waktunya
        $notifications = Notifikasi::where('status', 'scheduled')
            ->where('scheduled_at', '<=', $now)
            ->get();

        $this->info("Ditemukan {$notifications->count()} notifikasi untuk dikirim");

        foreach ($notifications as $notif) {
            // Update status ke pending
            $notif->update(['status' => 'pending']);

            // Kirim
            $response = $this->fonnte->sendMessage(
                $notif->target_number,
                $notif->message
            );

            $isSuccess = ($response->successful() && ($response['status'] ?? false));

            // Update hasil
            $notif->update([
                'status'           => $isSuccess ? 'sent' : 'failed',
                'response_code'    => $response->status(),
                'response_message' => json_encode($response->json()),
                'sent_at'          => $isSuccess ? Carbon::now() : null,
            ]);

            $status = $isSuccess ? 'berhasil' : 'gagal';
            $this->info("Notifikasi #{$notif->id} {$status} dikirim");
        }

        $this->info('Selesai!');
    }
}