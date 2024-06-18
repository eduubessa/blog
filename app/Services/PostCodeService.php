<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostCodeService {

    public function __construct(
        private string $key = config("services.postcode.key"),
        private string $url = config("services.postcode.url"),
        private string $postcode
    ) {

    }

    public function postcode(string $postcode): static
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function location(): string
    {
        $response = Http::get("{$this->baseUrl}/{$this->key}/{$this->postcode}");

        if($response->status() == 200){
            return $response->body();
        }else{
            Log::error("Código Postal Error | Status: {$response->status()} | Message: {$response->reason()}");
            return "Código Postal Error | Status: {$response->status()} | Message: {$response->reason()}";
        }
    }

}
