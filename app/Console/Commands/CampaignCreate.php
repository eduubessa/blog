<?php

namespace App\Console\Commands;

use App\Helpers\Interfaces\MailInterface;
use App\Models\Mail;
use App\Services\BrevoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CampaignCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:campaigns:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports campaigns from the database and creates them on an external service.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $this->service = new BrevoService();

        try {
            $mails = Mail::where('status', MailInterface::STATUS_DRAFT)
                ->orWhere('status', MailInterface::STATUS_ACTIVE);

            if($mails->count() > 0){
                foreach($mails->get() as $mail){
                    $this->service->createCampaignFromMail(mail: $mail);
                }
            }

        }catch(\Exception $exception) {
            echo 'Exception when calling EmailCampaignsApi->getEmailCampaigns: ', $exception->getMessage(), PHP_EOL;
            Log::error("BREVO API | CREATE CAMPAIGN ON SERVICE | ERROR: {$exception->getMessage()}");
        }
    }
}
