<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mataKuliahs = MataKuliah::where('user_id', Auth::id())->get();
        $totalMk = Matakuliah::where('user_id', Auth::id())->count();
        $totalSKS = Matakuliah::where('user_id',Auth::id())->sum('sks');
        return view('matakuliahs.index', compact('mataKuliahs','totalMk','totalSKS'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliahs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|unique:mata_kuliahs,kode_matkul',
            'nama_matkul' => 'required',
            'dosen' => 'nullable|string',
            'sks' => 'required|integer|min:1|max:6',
        ]);
            $validated['user_id'] = Auth::id();
        MataKuliah::create($validated);

        return redirect()->route('matakuliahs.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $matakuliah)
    {
        // pastikan hanya bisa lihat data miliknya sendiri
        $this->authorizeUser($matakuliah);

        return view('matakuliahs.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $matakuliah)
    {
        $this->authorizeUser($matakuliah);

        return view('matakuliahs.edit', compact('mataKuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $this->authorizeUser($matakuliah);

        $validated = $request->validate([
            'kode_matkul' => 'required|unique:mata_kuliahs,kode_matkul,' . $matakuliah->id,
            'nama_matkul' => 'required',
            'dosen' => 'nullable|string',
            'sks' => 'required|integer|min:1|max:6',
        ]);
        $validated['user_id'] = Auth::id();
        $matakuliah->update($validated);

        return redirect()->route('matakuliahs.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {
        $this->authorizeUser($matakuliah);

        $matakuliah->delete();

        return redirect()->route('matakuliahs.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }

    /**
     * Helper function untuk memastikan user hanya bisa akses datanya sendiri.
     */
    private function authorizeUser(MataKuliah $matakuliah)
    {
        if ($matakuliah->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengakses data ini.');
        }
    }
   
   
}
