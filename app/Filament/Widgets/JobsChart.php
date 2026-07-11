<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Job;
use App\Models\Candidate;

class JobsChart extends BarChartWidget
{
    // Ο τίτλος του γραφήματος
    protected static ?string $heading = 'Αιτήσεις ανά Αγγελία';

    // Κρατάμε το ίδιο ύψος με το Ντόνατ για να είναι ομοιόμορφα!
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        // Παίρνουμε όλες τις αγγελίες
        $jobs = Job::all();
        
        $labels = [];
        $data = [];

        // Μετράμε πόσους υποψηφίους έχει η καθεμία
        foreach ($jobs as $job) {
            $labels[] = $job->title;
            $data[] = Candidate::where('job_id', $job->id)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Αριθμός Αιτήσεων',
                    'data' => $data,
                    'backgroundColor' => '#f59e0b', // Ένα ωραίο πορτοκαλί χρώμα
                ],
            ],
            'labels' => $labels,
        ];
    }
}