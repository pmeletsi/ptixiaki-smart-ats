<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
use Filament\Resources\Pages\ListRecords;

class ListCandidates extends ListRecords
{
    protected static string $resource = CandidateResource::class;

    /**
     * Εδώ ορίζουμε ποιες ενέργειες (Buttons) φαίνονται πάνω δεξιά στη σελίδα.
     * Προσθέτουμε το κουμπί για δημιουργία νέου υποψηφίου.
     */
    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\CreateAction::make()
                ->label('Νέος Υποψήφιος'),
        ];
    }
}