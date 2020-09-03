<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PDF;

class SearchStaff extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staffs)
    {
        $this->staffs = $staffs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        view()->share('staffs',$this->staffs);
        $pdf = PDF::loadView('templates.pdf.staffs', $this->staffs);
        
        return $this->view('templates.mails.search_staffs')
            ->attachData($pdf->output(), 'staffs.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
