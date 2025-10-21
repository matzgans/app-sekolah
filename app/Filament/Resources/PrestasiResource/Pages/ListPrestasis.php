<?php

namespace App\Filament\Resources\PrestasiResource\Pages;

use App\Exports\PrestasiExport;
use App\Filament\Exports\PrestasiExporter;
use App\Filament\Resources\PrestasiResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListPrestasis extends ListRecords
{
    protected static string $resource = PrestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Prestasi'),
            Action::make('export')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function ($livewire) {
                    // 5. Ambil query yang sedang aktif/terfilter dari tabel
                    $query = $livewire->getFilteredTableQuery();

                    // 6. Tentukan nama file
                    $fileName = 'data-prestasi-' . date('Y-m-d') . '.xlsx';

                    // 7. Panggil download menggunakan facade Excel
                    // Kita kirim query-nya ke class PrestasiExport
                    return Excel::download(new PrestasiExport($query), $fileName);
                }),
        ];
    }
}
