<?php

namespace App\Http\Controllers;

use App\Models\Tugas;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Tampilkan daftar tugas milik user yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil hanya data milik user login
       

        // Ambil semua tugas milik user + relasi mata kuliah & jadwal
        $tugas = Tugas::where('user_id', $userId)
            ->with(['mataKuliah'])
            ->orderBy('deadline', 'asc')
            ->get();
        $totalTugas = Tugas::where('user_id', $userId)->count();
        $tugasSelesai = Tugas::where('user_id', $userId)
            ->where('status', 'dikerjakan')
            ->count();

         $tugasBelum = Tugas::where('user_id', $userId)
            ->where('status', 'belum dikerjakan')
            ->count();
        // Ambil data referensi untuk form
        return view('tugass.index', compact('tugas', 'totalTugas', 'tugasSelesai', 'tugasBelum'));

    }

    /**
     * Simpan tugas baru ke database.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            
            'mata_kuliah_id' => [
                'required',
                function ($attribute, $value, $fail) use ($userId) {
                    if (!MataKuliah::where('id', $value)->where('user_id', $userId)->exists()) {
                        $fail('Mata kuliah tidak valid untuk akun Anda.');
                    }
                },
            ],
            'judul_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'status' => 'required|in:belum dikerjakan,dikerjakan',
            'deadline' => 'required|date|after_or_equal:today',

        ]);
          if ($request->hasFile('file_lampiran')) {
    $filePath = $request->file('file_lampiran')->store('lampiran_tugas', 'public');
    $validated['file_lampiran'] = $filePath;
}
        $validated['user_id'] = $userId;

        Tugas::create($validated);

        return redirect()
            ->route('tugass.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Update data tugas.
     */
    public function update(Request $request, Tugas $tugass)
    {
        $this->authorizeUser($tugass);

        $userId = Auth::id();
// validasi read only
       $request->merge([
        'mata_kuliah_id' => $request->input('mata_kuliah_id', $tugass->mata_kuliah_id),
        'judul_tugas'    => $request->input('judul_tugas', $tugass->judul_tugas),
        'deskripsi'      => $request->input('deskripsi', $tugass->deskripsi),
    ]);

    $validated = $request->validate([
        'mata_kuliah_id' => [
            'required',
            function ($attribute, $value, $fail) use ($userId) {
                if (!MataKuliah::where('id', $value)->where('user_id', $userId)->exists()) {
                    $fail('Mata kuliah tidak valid untuk akun Anda.');
                }
            },
        ],
        'judul_tugas' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        // kalau mau mengganti file, user bisa upload; kalau tidak, tetap boleh null
        'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'status' => 'required|in:belum dikerjakan,dikerjakan',
        'deadline' => 'required|date|after_or_equal:today',
    ]);

       if ($request->hasFile('file_lampiran')) {
    $filePath = $request->file('file_lampiran')->store('lampiran_tugas', 'public');
    $validated['file_lampiran'] = $filePath;
}

        $tugass->update($validated);

        return redirect()
            ->route('tugass.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Hapus tugas dari database.
     */
    public function destroy(Tugas $tugass)
    {
        $this->authorizeUser($tugass);

        $tugass->delete();

        return redirect()
            ->route('tugass.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    /**
     * Pastikan hanya pemilik tugas yang bisa mengakses atau mengubah data.
     */
    private function authorizeUser(Tugas $tugass)
    {
        if ($tugass->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }
    }
}
