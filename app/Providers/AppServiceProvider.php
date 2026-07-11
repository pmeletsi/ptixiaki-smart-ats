<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationItems([
                
                // 1. Συνεντεύξεις (ΝΕΟ) 
                NavigationItem::make('Συνεντεύξεις')
                    ->url(url('/admin/candidates?tableFilters[status][value]=interview'))
                    ->icon('heroicon-s-chat')
                    ->sort(2),

                // 2. Προσλήψεις 
                NavigationItem::make('Προσλήψεις')
                    ->url(url('/admin/candidates?tableFilters[status][value]=hired'))
                    ->icon('heroicon-s-check-circle')
                    ->sort(3),
                    
                // 3. Απορρίψεις 
                NavigationItem::make('Απορρίψεις')
                    ->url(url('/admin/candidates?tableFilters[status][value]=rejected'))
                    ->icon('heroicon-s-x-circle')
                    ->sort(4),
            ]);
        });
    }
}