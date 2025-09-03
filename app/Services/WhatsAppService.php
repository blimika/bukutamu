<?php
    namespace App\Services;
    use Illuminate\Support\Facades\Http;

    class WhatsAppService
    {
        protected $baseUrl;
        protected $BasicUser;
        protected $BasicPasswd;

        public function __construct()
        {
            $this->baseUrl = env('APP_WA_LOKAL_URL');
            $this->BasicUser = env('APP_WA_LOKAL_AUTH_USER');
            $this->BasicPasswd = env('APP_WA_LOKAL_AUTH_PASSWD');
        }
        public function GetDevice()
        {
            try {
                $url_base = $this->baseUrl.'app/devices';
                $response = Http::withBasicAuth($this->BasicUser, $this->BasicPasswd)->withHeaders([
                'accept' => 'accept: application/json',
                    ])->get($url_base);
            } catch (\Throwable $e) {
                $response = Log::error('Check Nomor HP WA : ' . $e->getMessage());
                //return response()->json(['error' => 'Internal Server Error'],500);
            }
            return $response;
        }
        public function sendMessage($recipients, $message)
        {
            //$nomorhp = $this->cek_nomor_hp($recipients);
            //cek dulu ada WhatsApp apa tidak
            try {
                $url_base = $this->baseUrl.'user/check';
                $response = Http::withBasicAuth($this->BasicUser, $this->BasicPasswd)->withHeaders([
                'accept' => 'accept: application/json',
                    ])->get($url_base,[
                        'phone'=> $recipients
                    ]);
            } catch (\Throwable $e) {
                $response = Log::error('Check Nomor HP WA : ' . $e->getMessage());
                //return response()->json(['error' => 'Internal Server Error'],500);
            }
            //batas cek dulu
            /*
            {
                "code": "SUCCESS",
                "message": "Success check user",
                "results": {
                    "is_on_whatsapp": true
                }
                }
            */
            /*
            {
            "code": "SUCCESS",
            "message": "Message sent to 6281237802900@s.whatsapp.net (server timestamp: 2025-09-01 05:59:35 +0000 UTC)",
            "results": {
                "message_id": "3EB0972F007FCCE4DB8455",
                "status": "Message sent to 6281237802900@s.whatsapp.net (server timestamp: 2025-09-01 05:59:35 +0000 UTC)"
            }
            }
            */
            //delay
            sleep(1);
            if ($response['results']['is_on_whatsapp'] == true)
            {
                //ada whatsapp nomornya
                $url_base = $this->baseUrl.'send/message';
                $response = Http::withBasicAuth($this->BasicUser, $this->BasicPasswd)->withHeaders([
                'accept' => 'accept: application/json',
                ])->post($url_base,[
                    'phone' => $recipients.'@s.whatsapp.net',
                    'message' => $message,
                    "is_forwarded" => false,
                    "duration" => 0,
                ]);
                $arr = array(
                    'status' => true,
                    'hasil'=> $response
                );
            }
            else
            {
                $arr = array(
                    'status'=> false,
                    'hasil' => "Error, nomor tidak ada WhatsApp",
                );
            }
           return $response;
        }
    }
