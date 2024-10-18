<?php

use Karson\MpesaPhpSdk\Mpesa;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('mpesa', function () {
    $mpesaInstance = new Mpesa();
    $mpesaInstance->setPublicKey(config('mpesa.public_key'));
    $mpesaInstance->setApiKey(config('mpesa.api_key')); //test
    $mpesaInstance->setEnv(config('mpesa.env'));
    $mpesaInstance->setServiceProviderCode(config('mpesa.service_provider_code'));

    $response = $mpesaInstance->c2b("EST93Q432123", "258847049818", 500, "PAY4SF871" . rand(100, 1000));

    Log::info(json_encode($response));
});
