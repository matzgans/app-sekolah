<?php

namespace App\Policies;

use App\Models\ProfileSekolah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfileSekolahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasRole(['admin', 'kepsek', 'Kepsek']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProfileSekolah $profileSekolah): bool
    {
        return auth()->user()->hasRole(['admin', 'kepsek', 'Kepsek']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProfileSekolah $profileSekolah): bool
    {
        return auth()->user()->hasRole(['admin', 'kepsek', 'Kepsek']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProfileSekolah $profileSekolah): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public function bulkDelete(User $user, ProfileSekolah $profileSekolahs): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProfileSekolah $profileSekolah): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProfileSekolah $profileSekolah): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
