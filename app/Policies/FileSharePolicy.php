<?php

namespace App\Policies;

use App\Models\User;

class FileSharePolicy
{
    /**
     * Create a new policy instance.
     */
    public function share(User $user, File $file)
    {
        return $user->id === $file->user_id;
    }
    
    public function revoke(User $user, File $file)
    {
        return $user->id === $file->user_id;
    }
}
