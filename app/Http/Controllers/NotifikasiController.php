<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tugas;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FonteNotifikasiService;

class NotifikasiController extends Controller
{
    protected $fonnte;

    public function __construct(FonteNotifikasiService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    /**
     * Kirim atau Jadwalkan Notifikasi WhatsApp
     */
    public function send(Request $request)
    {
        $request->validate([
            'tugas_id'      => 'required|exists:tugass,id',
            'target_number' => 'required',
            'message'       => 'required',
            'send_type'     => 'required|in:now,scheduled',
            'scheduled_at'  => 'required_if:send_type,scheduled|nullable|date|after:now'
        ]);

        $userId = Auth::id();

        // Validasi: tugas harus milik user login
        $tugas = Tugas::where('id', $request->tugas_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Tentukan apakah langsung kirim atau dijadwalkan
        $sendNow = ($request->send_type === 'now');
        $scheduledAt = $sendNow ? null : Carbon::parse($request->scheduled_at);

        // Simpan notifikasi
        $notif = Notifikasi::create([
            'user_id'       => $userId,
            'tugas_id'      => $tugas->id,
            'target_number' => $request->target_number,
            'message'       => $request->message,
            'scheduled_at'  => $scheduledAt,
            'status'        => $sendNow ? 'pending' : 'scheduled'
        ]);

        // Jika kirim sekarang
        if ($sendNow) {
            $this->sendNotification($notif);
        }

        return response()->json([
            'success' => true,
            'message' => $sendNow ? 'Notifikasi berhasil dikirim' : 'Notifikasi berhasil dijadwalkan',
            'data'    => $notif,
        ]);
    }

    /**
     * Proses pengiriman notifikasi
     */
    protected function sendNotification(Notifikasi $notif)
    {
        // Kirim via API Fonnte
        $response = $this->fonnte->sendMessage(
            $notif->target_number,
            $notif->message
        );

        $isSuccess = ($response->successful() && ($response['status'] ?? false));

        // Update status
        $notif->update([
            'status'           => $isSuccess ? 'sent' : 'failed',
            'response_code'    => $response->status(),
            'response_message' => json_encode($response->json()),
            'sent_at'          => $isSuccess ? Carbon::now() : null,
        ]);

        return $isSuccess;
    }

    /**
     * Form notifikasi + daftar tugas milik user
     */
    public function create()
    {
        $userId = Auth::id();

        $notifikasi = Notifikasi::with('tugas')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->get();

        $tugas = Tugas::where('user_id', $userId)->get();

        return view('notifikasi.create', compact('notifikasi', 'tugas'));
    }

    /**
     * Detail notifikasi (hanya milik user login)
     */
    public function show($id)
    {
        $userId = Auth::id();

        return Notifikasi::with('tugas')
            ->where('user_id', $userId)
            ->findOrFail($id);
    }

    /**
     * Hapus notifikasi yang terjadwal
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        $notif = Notifikasi::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();

        // Hanya bisa hapus yang berstatus scheduled
        if ($notif->status === 'scheduled') {
            $notif->delete();
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi terjadwal berhasil dihapus'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Hanya notifikasi terjadwal yang bisa dihapus'
        ], 400);
    }
}