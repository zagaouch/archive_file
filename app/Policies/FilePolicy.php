<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can view the file.
     */
    public function view(User $user, File $file): bool
    {
        return $user->id === $file->user_id;
    }

    /**
     * Determine if the user can download the file.
     */
    public function download(User $user, File $file): bool
    {
        return $user->id === $file->user_id;
    }

    /**
     * Determine if the user can delete the file.
     */
    public function delete(User $user, File $file): bool
    {
        return $user->id === $file->user_id;
    }
}