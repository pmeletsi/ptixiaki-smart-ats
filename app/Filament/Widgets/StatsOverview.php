<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            
             // 5. Ενεργές Αγγελίες
            Card::make('Ενεργές Αγγελίες', Job::where('is_active', true)->count())
                ->description('Ανοιχτές θέσεις')
                ->descriptionIcon('heroicon-s-briefcase')
                ->color('success'),

            // 1. Σύνολο Υποψηφίων
            Card::make('Σύνολο Υποψηφίων', Candidate::count())
                ->description('Όλες οι αιτήσεις')
                ->descriptionIcon('heroicon-s-users')
                ->color('primary'),

            // 2. Υποψήφιοι για Συνέντευξη
            Card::make('Για Συνέντευξη', Candidate::where('status', 'interview')->count())
                ->description('Επόμενο βήμα')
                ->descriptionIcon('heroicon-s-chat')
                ->color('warning'),

            // 3. Προσλήψεις (ΝΕΟ) ✅
            Card::make('Προσλήψεις', Candidate::where('status', 'hired')->count())
                ->description('Επιτυχημένες προσλήψεις')
                ->descriptionIcon('heroicon-s-check-circle')
                ->color('success'),

            // 4. Απορρίψεις (ΝΕΟ) ❌
            Card::make('Απορρίψεις', Candidate::where('status', 'rejected')->count())
                ->description('Δεν επιλέχθηκαν')
                ->descriptionIcon('heroicon-s-x-circle')
                ->color('danger'), // Το danger το κάνει κόκκινο

        ];
    }
}