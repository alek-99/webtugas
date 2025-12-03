<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    Protected $table = 'jadwals';
    Protected $fillable = ['user_id',
    'hari',
    'jam_mulai',
    'jam_selesai',
    'ruang',
    'mata_kuliah_id',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
    // public function tugass()
    // {
    //     return $this->hasMany(Tugas::class);
    // }
}
