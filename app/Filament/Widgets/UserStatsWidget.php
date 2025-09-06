<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{

    /**
     * Method ini akan menentukan apakah widget boleh ditampilkan atau tidak.
     * Widget hanya akan muncul jika method ini mengembalikan nilai true.
     *
     * @return bool
     */
    public static function canView(): bool // <-- TAMBAHKAN METHOD INI
    {
        // Cek apakah pengguna yang sedang login memiliki role 'admin' ATAU 'Kepsek'
        return auth()->user()->hasAnyRole(['admin', 'Kepsek', 'kepsek']);
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah semua pengguna terdaftar')
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }

    protected static ?int $sort = 2;
}
