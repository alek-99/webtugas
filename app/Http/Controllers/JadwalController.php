<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::with('mata_kuliah')->where('user_id', Auth::id())->get();
        $mataKuliahs = MataKuliah::where('user_id', Auth::id())->get();
        $jadwalSenin = $jadwals->where('hari', 'Senin')->count();
        $jadwalPerHari = [
    'Senin' => $jadwals->where('hari', 'Senin')->count(),
    'Selasa' => $jadwals->where('hari', 'Selasa')->count(),
    'Rabu' => $jadwals->where('hari', 'Rabu')->count(),
    'Kamis' => $jadwals->where('hari', 'Kamis')->count(),
    'Jumat' => $jadwals->where('hari', 'Jumat')->count(),
];
        return view('jadwals.index', compact('jadwals', 'mataKuliahs', 'jadwalPerHari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        'ruang' => 'required|string|max:100',
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
    ]);

    $validated['user_id'] = Auth::id();

    Jadwal::create($validated);

    return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        $this->authorizeUser($jadwal);
        return view('jadwals.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $this->authorizeUser($jadwal);
        return view('jadwals.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
       $this->authorizeUser($jadwal);
// dd($jadwal);

$validated = $request->validate([
    'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
    'jam_mulai' => 'required|date_format:H:i',
    'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    'ruang' => 'required|string|max:100',
    'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
]);

$validated['user_id'] = Auth::id();

$jadwal->update($validated);

    
    return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $this->authorizeUser($jadwal);
        $jadwal->delete();
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }
    public function authorizeUser($jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
