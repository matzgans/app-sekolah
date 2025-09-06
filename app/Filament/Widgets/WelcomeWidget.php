<?php

namespace App\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{

    use InteractsWithActions;
    use InteractsWithForms;
    protected static ?int $sort = 1;
    protected static string $view = 'filament.widgets.welcome-widget';

    public function getLogoutAction(): Action
    {
        return Action::make('logout')
            ->label('Logout')
            ->icon('heroicon-o-arrow-left-on-rectangle')
            ->color('gray')
            ->action(fn() => redirect(filament()->getLogoutUrl()));
    }
}
