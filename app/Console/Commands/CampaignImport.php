<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\User;
use App\Services\BrevoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CampaignImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:campaigns:import {--user=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all campaigns from Brevo API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->service  = new BrevoService();

        if(!is_null($this->option('user'))){
            $user  = User::where('username', $this->option('user'))->first();
        }

        if($this->service->countCampaigns() > 0){
            $service_campaigns = $this->service->getAllCampaigns();

            foreach($service_campaigns as $service_campaign){
                $campaign_per_code = Campaign::where('code', base64_encode($service_campaign["id"]));

                if($campaign_per_code->count() <= 0 && !str_contains($service_campaign["name"], "Created by CRM")){
                    echo "Importar a campanha: {$service_campaign["name"]}\n";
                    echo str_contains($service_campaign["name"], "Created by CRM");
                    try {
                        // Create campaign on local database
                        $campaign = new Campaign();
                        $campaign->code = base64_encode($service_campaign["id"]);
                        $campaign->name = $service_campaign["name"];
                        $campaign->subject = $service_campaign["subject"];
                        $campaign->previewText = $service_campaign["previewText"];
                        $campaign->htmlContent = $service_campaign["htmlContent"];
                        $campaign->save();
                    }catch(\Exception $exception){
                        Log::warning("IMPORT CAMPAIGN | SERVICE ID: {$service_campaign["id"]} | ERROR: Not inserted on local database | Reason: {$exception->getMessage()}");
                    }

                }else if($campaign_per_code->count() == 1 && !str_contains($service_campaign["name"], "Created by CRM")){
                    echo "Atualizar a campanha: {$service_campaign["name"]}\n";
                    echo str_contains($service_campaign["name"], "Created by CRM");
                    try {
                        // Update campaign on local database
                        $campaign = $campaign_per_code->first();
                        $campaign->name = $service_campaign["name"];
                        $campaign->subject = $service_campaign["subject"];
                        $campaign->previewText = $service_campaign["previewText"];
                        $campaign->htmlContent = $service_campaign["htmlContent"];
                        $campaign->save();

                    }catch(\Exception $exception){
                        Log::warning("UPDATE CAMPAIGN | SERVICE ID: {$service_campaign["id"]} | ERROR: Not updated on local database | Reason: {$exception->getMessage()}");
                    }
                }
            }
        }
    }
}
