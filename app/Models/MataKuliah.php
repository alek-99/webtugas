<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    Protected $table = 'mata_kuliahs';
    Protected $fillable = ['kode_matkul', 'nama_matkul', 'dosen', 'sks','user_id'];

    Protected $casts = [
        'sks' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function tugass()
    {
        return $this->hasMany(Tugas::class);
    }
}
