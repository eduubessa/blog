<?php

namespace App\Services;

use App\Models\Mail;
use GuzzleHttp\Client;
use Brevo\Client\Configuration;
use Brevo\Client\Api\AccountApi;
use Illuminate\Support\Facades\Log;
use Brevo\Client\Api\EmailCampaignsApi;

class BrevoService
{
    private string $key;
    private mixed $api_instance;
    private mixed $account;
    private Configuration $configuration;

    public function __construct() {
        $this->key = config('services.brevo.key');
        $this->authenticate();
    }

    private function authenticate(): void
    {
        $this->configuration = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->key);

        try {

            $this->api_instance = new AccountApi(new Client(), $this->configuration);
            $this->account = $this->api_instance->getAccount();

        }catch(\Exception $exception){
            echo 'Exception when calling AccountApi->getAccountInfo: ', $exception->getMessage(), PHP_EOL;
            Log::error("BREVO API | ERROR: {$exception->getMessage()}");
            exit(1);
        }
    }

    public function getAllCampaigns(): mixed
    {
        try {
            $this->api_instance = new EmailCampaignsApi(new Client(), $this->configuration);
            $response = $this->api_instance->getEmailCampaigns();
            return $response["campaigns"];
        }catch(\Exception $exception){
            echo 'Exception when calling EmailCampaignsApi->getEmailCampaigns: ', $exception->getMessage(), PHP_EOL;
            Log::error("BREVO API | ERROR: {$exception->getMessage()}");
        }

        return null;
    }

    public function countCampaigns(): int
    {
        try {
            $this->api_instance = new EmailCampaignsApi(new Client(), $this->configuration);
            $response = $this->api_instance->getEmailCampaigns();
            return (int)$response["count"];
        }catch(\Exception $exception){
            echo 'Exception when calling EmailCampaignsApi->getEmailCampaigns: ', $exception->getMessage(), PHP_EOL;
            Log::error("BREVO API | ERROR: {$exception->getMessage()}");
        }

        return 0;
    }

    public function createCampaignFromMail(Mail $mail): void
    {
        try {
            $campaign = [
                'name' => "{$mail->name} | Created by CRM",
                'subject' => $mail->subject,
                'htmlContent' => $mail->htmlContent,
                'sender' => [
                    'name' => config('app.name'),
                    'email' => config('services.brevo.sender')
                ]
            ];

            $this->api_instance = new EmailCampaignsApi(new Client(), $this->configuration);
            $response = $this->api_instance->createEmailCampaign($campaign);

            Log::info("BREVO API | CREATE CAMPAIGN ON SERVICE | SUCCESS: {$response}");
        }catch(\Exception $exception){
            Log::error("BREVO API | ERROR: {$exception->getMessage()}");
        }
    }
}
