<?php

namespace App\Services;

use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\EmailCampaignsApi;
use Brevo\Client\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Email;

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
}
