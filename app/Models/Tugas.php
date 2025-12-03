<?php

namespace App\Models;

use App\Models\Notifikasi;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    Protected $table = 'tugass';
    Protected $fillable = ['user_id','mata_kuliah_id','judul_tugas','deskripsi','file_lampiran','status','deadline'];
    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
public function notifikasi()
{
    return $this->hasMany(Notifikasi::class);
}
}
