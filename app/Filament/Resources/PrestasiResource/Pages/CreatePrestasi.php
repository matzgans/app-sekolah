<?php

namespace App\Filament\Resources\PrestasiResource\Pages;

use App\Filament\Resources\PrestasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrestasi extends CreateRecord
{
    protected static string $resource = PrestasiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        if (isset($data['galeris'])) {

            $filteredGaleris = collect($data['galeris'])
                ->filter(function ($item) {
                    return !empty($item['gambar']);
                })
                ->values()
                ->all();


            $data['galeris'] = $filteredGaleris;
        }

        return $data;
    }
}
