<?php

namespace App\Helpers\Scripts\Mail;

use App\Helpers\Interfaces\MailInterface;
use App\Models\Mail;
use Illuminate\Support\Facades\Log;

class BirthdayReminderMail {

    public static function create(string $to): void
    {
        $mail = new Mail();
        $mail->from = config('mail.from.address');
        $mail->to  = $to;
        $mail->subject = "A Clinica Mais informa os aniversários!";
        $mail->body = "IGNORE BODY";
        $mail->type = MailInterface::TYPE_CONTENT_HTML;
        $mail->layout = MailInterface::LAYOUT_BIRTHDAY_REMINDER_CUSTOM;

        if(!$mail->save()){
            Log::danger("FAILED | CREATE BIRTHDAY EMAIL TO {$mail->to}! TRY AGAIN, PLEASE!");
        }
    }

    public static function update(int $id, string $status): void
    {
        $mail = Mail::find($id);
        $mail->status = $status;

        if(!$mail->save()){
            Log::danger("FAILED | ID: {$mail->id} | UPDATED BIRTHDAY EMAIL STATUS TO {$mail->to}! TRY AGAIN, PLEASE!");
        }
    }

}
