<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    protected $table = 'notifikasi';
    protected $fillable = [
        'user_id',
        'tugas_id',
        'target_number',
        'message',
        'scheduled_at',
        'status',
        'response_code',
        'response_message',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    // Validation rules helper
    public static function statusOptions()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_SCHEDULED,
            self::STATUS_SENT,
            self::STATUS_FAILED,
        ];
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isScheduled()
    {
        return $this->status === self::STATUS_SCHEDULED;
    }

    public function isSent()
    {
        return $this->status === self::STATUS_SENT;
    }

    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }
}