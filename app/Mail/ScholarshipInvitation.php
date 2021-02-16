<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ScholarshipAttendee;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScholarshipInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $attendee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ScholarshipAttendee $scholarshipAttendee)
    {
        $this->attendee = $scholarshipAttendee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.scholarship')
                    ->subject('NIIT Scholarship');;
    }
}
