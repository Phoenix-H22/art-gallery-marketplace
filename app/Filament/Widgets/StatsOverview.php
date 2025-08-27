<?php

namespace App\Filament\Widgets;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Artists', User::where('role', 'artist')->count())
                ->description('Registered artists')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Artworks', Artwork::count())
                ->description('Available artworks')
                ->descriptionIcon('heroicon-m-paint-brush')
                ->color('primary'),

            Stat::make('Total Videos', Video::count())
                ->description('Artist videos')
                ->descriptionIcon('heroicon-m-video-camera')
                ->color('warning'),

            Stat::make('Categories', Category::count())
                ->description('Art categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
