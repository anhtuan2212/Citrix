<?php

namespace App\Mail;

use App\Models\CurriculumVitae;
use App\Models\interview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use PgSql\Lob;

class PersonnelAcceptMailer extends Mailable
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
        $cver = CurriculumVitae::find($this->id);
        $inter = interview::find($cver->interview_id);
        return $this->view('mail.PersonnelAccetptMail', compact('cver', 'inter'))->subject('Thông Báo Trúng Tuyển SCONNECT');
    }
}
