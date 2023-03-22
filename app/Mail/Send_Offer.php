<?php

namespace App\Mail;

use App\Models\CurriculumVitae;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Send_Offer extends Mailable
{
    use Queueable, SerializesModels;

    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function build()
    {
        $cver = CurriculumVitae::getCVByID($this->id);
        // dd($cver);
        $current = Carbon::now();
        $date_contract = $current->addDays(7);
        if ($date_contract->dayOfWeek == Carbon::SUNDAY) {
            $date_contract = $current->addDays(8);
        }
        return $this->view('mail.Offer', compact('cver', 'date_contract'))->subject('Xin chúc mừng! Bạn đã trúng tuyển ' . $cver[0]->nominees . ' tại SCONNECT');
    }
}
