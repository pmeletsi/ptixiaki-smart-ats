<?php

namespace App\Filament\Widgets;

use Filament\Widgets\DoughnutChartWidget;
use App\Models\Candidate;

class CandidateStatusChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Ποσοστά Υποψηφίων (%)';

    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $total = Candidate::count();

        // Υπολογισμός ποσοστών (με 1 δεκαδικό ψηφίο)
        $newPct       = $total > 0 ? round((Candidate::where('status', 'new')->count() / $total) * 100, 1) : 0;
        $interviewPct = $total > 0 ? round((Candidate::where('status', 'interview')->count() / $total) * 100, 1) : 0;
        $hiredPct     = $total > 0 ? round((Candidate::where('status', 'hired')->count() / $total) * 100, 1) : 0;
        $rejectedPct  = $total > 0 ? round((Candidate::where('status', 'rejected')->count() / $total) * 100, 1) : 0;

        return [
            'datasets' => [
                [
                    'label' => 'Ποσοστό (%)',
                    'data' => [$newPct, $interviewPct, $hiredPct, $rejectedPct],
                    'backgroundColor' => [
                        '#3b82f6', // Μπλε
                        '#eab308', // Κίτρινο
                        '#22c55e', // Πράσινο
                        '#ef4444', // Κόκκινο
                    ],
                ],
            ],
            
          // Βάζουμε το (%) δίπλα στο όνομα
            'labels' => [
                'Νέες Αιτήσεις (%)', 
                'Σε Συνέντευξη (%)', 
                'Προσλήψεις (%)', 
                'Απορρίψεις (%)'
            ],
        ];
    }
}