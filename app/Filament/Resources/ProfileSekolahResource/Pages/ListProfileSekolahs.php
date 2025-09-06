<?php

namespace App\Filament\Resources\ProfileSekolahResource\Pages;

use App\Filament\Resources\ProfileSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileSekolahs extends ListRecords
{
    protected static string $resource = ProfileSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
