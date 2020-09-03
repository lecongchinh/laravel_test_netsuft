<?php

namespace App\Jobs;

use App\Mail\SearchStaff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $staffs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $staffs)
    {
        $this->email = $email;
        $this->staffs = $staffs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new SearchStaff($this->staffs);
        Mail::to($this->email)->send($mail);
    }
}
