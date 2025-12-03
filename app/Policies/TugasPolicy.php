<?php

namespace App\Policies;

use App\Models\Tugas;
use App\Models\User;

class TugasPolicy
{
    /**
     * Pastikan hanya pemilik tugas yang bisa melihat, mengedit, atau menghapusnya.
     */
    public function view(User $user, Tugas $tugas)
    {
        return $user->id === $tugas->user_id;
    }

    public function update(User $user, Tugas $tugas)
    {
        return $user->id === $tugas->user_id;
    }

    public function delete(User $user, Tugas $tugas)
    {
        return $user->id === $tugas->user_id;
    }
}
