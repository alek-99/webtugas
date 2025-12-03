<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $tugass = Tugas::where('user_id', $userId)->get();
        $mataKuliahs = MataKuliah::where('user_id', $userId)->get();
        $jadwals = Jadwal::where('user_id', $userId)->get();
// $aktivitasTerbaru = $tugass->sortByDesc('created_at')->take(5);
        $totaltugass = $tugass->count();
        $totalMK = $mataKuliahs->count();
        $totaljadwals = $jadwals->count();
        $tugasProses = $tugass->where('status', 'belum dikerjakan')->count();
        $tugasSelesai = $tugass->where('status', 'dikerjakan')->count();
        return view('dashboard', compact('tugass', 'mataKuliahs', 'jadwals', 'totaltugass', 'totalMK', 'totaljadwals','tugasProses','tugasSelesai'));
    }
}
