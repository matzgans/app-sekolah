<?php

namespace App\Filament\Resources\RoleResource\Pages;

// Kita extend (warisi) dari halaman ListRoles milik plugin
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\ListRoles as VendorListRoles;

class ListRoles extends VendorListRoles
{
    // Kita paksa judulnya di sini
    public function getTitle(): string
    {
        return 'Role';
    }
}
