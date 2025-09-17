<?php

namespace App\Filament\Resources\PrestasiResource\Pages;

use App\Filament\Resources\PrestasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrestasi extends EditRecord
{
    protected static string $resource = PrestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['galeris'])) {
            $data['galeris'] = collect($data['galeris'])
                ->filter(fn($item) => !empty($item['gambar']))
                ->values()
                ->all();
        }

        return $data;
    }
}
