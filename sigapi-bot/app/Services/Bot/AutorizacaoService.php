<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;
use Carbon\Carbon;

class AutorizacaoService extends AbstractService {

    public function process($chatId, $authorizationCode) {

        Log::debug('AutorizacaoService.process - INICIO');

        try {

            $redirectUrl = route('autorizacao', [
                'chatId' => $chatId
            ]);

            $client = new Client();
            $response = $client->post(
                "http://login.sigapi.info/oauth/token?code=$authorizationCode&grant_type=authorization_code&redirect_uri=$redirectUrl",
                [
                    'auth' => ['exemplo', 'exemplo'],
                ]
            );

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody()->getContents();
                $json = json_decode($body);

                $accessToken = $json->access_token;
                $expiresIn = $json->expires_in;
                $expiresAt = Carbon::now()->addSeconds($expiresIn);
                Cache::put($chatId, $accessToken, $expiresAt);

                self::sendMessage($chatId, "✅ Seu acesso foi configurado corretamente e é válido até " . $expiresAt->format('\à\s H\hi \d\o \d\i\a d-m-Y'));
                return true;
            }

        } catch (RequestException $e) {

            $response = $e->getResponse();
            $body = $response->getBody()->getContents();
            $json = json_decode($body);
            $message = null;

            if ($json) {

                if (isset($json->error_description)) {
                    $message = $json->error_description;
                }

                if (!$message) {
                    if (isset($json->message)) {
                        $message = $json->message;
                    }
                }

            }

            if (!$message) {
                $message = $body;
            }

            self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro e não foi possível se conectar: *$message*");
            return false;

        } catch (\Exception $e) {

            self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro desconhecido e não foi possível se conectar");
            return false;

        }

        self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro desconhecido e não foi possível se conectar");

        Log::debug('AutorizacaoService.process - FIM');
        return false;

    }

}
