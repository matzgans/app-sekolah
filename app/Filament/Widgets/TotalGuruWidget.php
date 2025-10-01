<?php

namespace App\Filament\Widgets;

use App\Models\Guru;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalGuruWidget extends BaseWidget
{

    public static function canView(): bool // <-- TAMBAHKAN METHOD INI
    {
        // Cek apakah pengguna yang sedang login memiliki role 'admin' ATAU 'Kepsek'
        return auth()->user()->hasAnyRole(['admin', 'Kepsek', 'kepsek']);
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Guru', Guru::count())
                ->description('Jumlah semua guru terdaftar')
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }

    protected static ?int $sort = 3;
}
