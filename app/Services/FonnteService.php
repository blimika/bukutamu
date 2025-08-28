<?php
    namespace App\Services;
    use Illuminate\Support\Facades\Http;

    class FonnteService
    {
        protected $baseUrl = 'https://api.fonnte.com/';
        protected $apiToken;

        public function __construct()
        {
            $this->apiToken = env('APP_WA_API');
        }

        public function sendMessage($recipients, $message, $additionalParams = [])
        {
            $response = Http::withHeaders([
                'Authorization' => $this->apiToken,
            ])->post($this->baseUrl . 'send', array_merge([
                'target' => is_array($recipients) ? implode(',', $recipients) : $recipients,
                'message' => $message,
            ], $additionalParams));

            return $response->json();
        }
    }
