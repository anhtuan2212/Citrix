<?php

namespace App\Jobs;

use App\Mail\PassCV_FaildInter;
use App\Mail\PersonnelAcceptMailer;
use App\Mail\PersonnelFaildCVMailer;
use App\Mail\Send_Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mail;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $mail)
    {
        $this->id = $id;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            //send mail offer
            if ($this->mail == 1) {
                Mail::to('lutl@s-connect.net')->send(new Send_Offer($this->id));
            } else if ($this->mail == 2) { //Mail xếp lịch 
                Mail::to('lutl@s-connect.net')->send(new PersonnelAcceptMailer($this->id));
            } else if ($this->mail == 3) { //Mail từ chối CV
                Mail::to('lutl@s-connect.net')->send(new PersonnelFaildCVMailer($this->id));
            } else if ($this->mail == 4) { //Mail fail phỏng vấn
                Mail::to('lutl@s-connect.net')->send(new PassCV_FaildInter($this->id));
            }
        } catch (\Exception $th) {
            Log::error('Thất Bại :' . $th->getMessage());
        }
    }
}
