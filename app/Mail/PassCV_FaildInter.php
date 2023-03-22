<?php

namespace App\Mail;

use App\Models\CurriculumVitae;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PassCV_FaildInter extends Mailable
{
    use Queueable, SerializesModels;

    private $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function build()
    {
        $cver =
            CurriculumVitae::leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees')->where('curriculum_vitaes.id', '=', "$this->id")->get();
        $user = "Nhân Sự Hành Chính";
        return $this->view('mail.PassCV_FaildInter', compact('cver', 'user'))->subject('Thông báo Tình Trạng Ứng Tuyển tại SCONNECT');
    }
}
