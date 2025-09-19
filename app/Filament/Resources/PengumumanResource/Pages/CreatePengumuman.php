<?php

namespace App\Filament\Resources\PengumumanResource\Pages;

use App\Filament\Resources\PengumumanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePengumuman extends CreateRecord
{
    protected static string $resource = PengumumanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Menambahkan user_id dari pengguna yang sedang login ke dalam data form
        $data['user_id'] = Auth::id();

        // Mengembalikan data yang sudah dimodifikasi untuk disimpan
        return $data;
    }
}
