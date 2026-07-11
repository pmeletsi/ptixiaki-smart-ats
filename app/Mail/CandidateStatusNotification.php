<?php

namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    public function build()
    {
        return $this->subject('Ενημέρωση Κατάστασης Αίτησης - SmartRecruit')
                    ->view('emails.candidate_status');
    }
}