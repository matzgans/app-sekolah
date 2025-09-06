<?php

namespace App\Filament\Resources\ProfileSekolahResource\Pages;

use App\Filament\Resources\ProfileSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileSekolah extends EditRecord
{
    protected static string $resource = ProfileSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
