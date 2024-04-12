<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;


use App\Filament\Widgets\FavoriteProjects;
use App\Filament\Widgets\LatestActivities;
use App\Filament\Widgets\LatestComments;
use App\Filament\Widgets\LatestProjects;
use App\Filament\Widgets\LatestTickets;
use App\Filament\Widgets\TicketsByPriority;
use App\Filament\Widgets\TicketsByType;
use App\Filament\Widgets\TicketTimeLogged;
use App\Filament\Widgets\UserTimeLogged;
use Illuminate\Support\Facades\Route;

use Filament\Pages\Dashboard as BasePage;

class Dashboard extends Page
{


    protected function getColumns(): int|array
    {
        return 6;
    }


    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament::pages.dashboard';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$title ?? __('filament::pages/dashboard.title');
    }

    public static function getRoutes(): \Closure
    {
        return function () {
            Route::get('/dashboard', static::class)->name(static::getSlug());
        };
    }
    protected function getWidgets(): array
    {
        return [
            ...Filament::getWidgets(),
            FavoriteProjects::class,
            LatestActivities::class,
            LatestComments::class,
            LatestProjects::class,
            LatestTickets::class,
            TicketsByPriority::class,
            TicketsByType::class,
            TicketTimeLogged::class,
            UserTimeLogged::class
        ];
    }




    protected function getTitle(): string
    {
        return static::$title ?? __('filament::pages/dashboard.title');
    }
}
