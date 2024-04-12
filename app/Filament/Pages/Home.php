<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FavoriteProjects;
use App\Filament\Widgets\LatestActivities;
use App\Filament\Widgets\LatestComments;
use App\Filament\Widgets\LatestProjects;
use App\Filament\Widgets\LatestTickets;
use App\Filament\Widgets\TicketsByPriority;
use App\Filament\Widgets\TicketsByType;
use App\Filament\Widgets\TicketTimeLogged;
use App\Filament\Widgets\UserTimeLogged;
use App\Models\Project;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Home extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-view-boards';

    protected static string $view = 'filament.pages.home';

    protected static ?string $slug = 'home';

    protected static ?int $navigationSort = 4;

    protected function getWidgets(): array
    {
        return [
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
}
