<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Mail;
use App\Models\User;
use App\Services\BrevoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CampaignUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:campaigns:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the HTML content of notification emails for campaigns.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $this->service  = new BrevoService();

        if($this->service->countCampaigns() > 0){
            foreach($this->service->getAllCampaigns() as $campaign_mail){
                if(str_contains($campaign_mail["name"], "| Created by CRM")){
                    try {
                        // Create campaign on external service
                        Mail::where('name',  str_replace(' | Created by CRM', '', $campaign_mail["name"]))->update([
                            'htmlContent' => $campaign_mail["htmlContent"]
                        ]);
                    }catch(\Exception $exception){
                        Log::warning("UPDATE CAMPAIGN | SERVICE ID: {$campaign_mail["name"]} | ERROR: Not updated on local database | Reason: {$exception->getMessage()}");
                    }
                }
            }
        }
    }
}
