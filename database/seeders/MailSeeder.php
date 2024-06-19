<?php

namespace Database\Seeders;

use App\Models\Mail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $mail = new Mail();
        $mail->name = "Aniversário | Cliente Golden";
        $mail->subject = "Desejamos-lhe um feliz aniversário!";
        $mail->previewText = "Desejamos-lhe um feliz aniversário!";
        $mail->htmlContent = "ALTERAR O HTML NO BREVO";
        $mail->save();

        $mail = new Mail();
        $mail->name = "Aniversário | Cliente Silver";
        $mail->subject = "Desejamos-lhe um feliz aniversário!";
        $mail->previewText = "Desejamos-lhe um feliz aniversário!";
        $mail->htmlContent = "ALTERAR O HTML NO BREVO";
        $mail->save();

        $mail = new Mail();
        $mail->name = "Aniversário | Cliente Bronze";
        $mail->subject = "Desejamos-lhe um feliz aniversário!";
        $mail->previewText = "Desejamos-lhe um feliz aniversário!";
        $mail->htmlContent = "ALTERAR O HTML NO BREVO";
        $mail->save();

        $mail = new Mail();
        $mail->name = "Boas vindas";
        $mail->subject = "Desejamos-lhe as boas vindas";
        $mail->previewText = "Desejamos-lhe as boas vindas";
        $mail->htmlContent = "ALTERAR O HTML NO BREVO";
        $mail->save();
    }
}
