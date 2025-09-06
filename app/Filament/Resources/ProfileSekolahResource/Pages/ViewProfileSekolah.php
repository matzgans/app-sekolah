<?php

namespace App\Filament\Resources\ProfileSekolahResource\Pages;

use App\Filament\Resources\ProfileSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProfileSekolah extends ViewRecord
{
    protected static string $resource = ProfileSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
