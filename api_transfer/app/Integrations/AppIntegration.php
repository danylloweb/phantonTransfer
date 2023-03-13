<?php

namespace App\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\StreamInterface;

/**
 * AppIntegration
 */
class AppIntegration
{
    /**
     * @var Client
     */
    protected $clientService;

    /*
     * $serviceConfig
     */
    protected $serviceConfig;


    /**
     * @return Client
     */
    private function getHttpRequest():Client
    {
        return new Client(['verify' => false]);
    }

    /**
     * @return mixed
     */
    private function getBaseUrl()
    {
        return config("$this->serviceConfig.url");
    }

    /**
     * @return array|StreamInterface
     */
    protected function processRequest()
    {
        try {
            $endpoint = $this->getBaseUrl();
            $options  = [
                'headers' => [
                    'Accept' => '*/*',
                ],
            ];
          return json_decode($this->getHttpRequest()->request('GET', $endpoint, $options)->getBody(),true);

        } catch (GuzzleException $e) {

            Log::info(json_encode(['error' => true, 'message' => $e->getMessage()]));
            return ['error' => true, 'message' => "Serviço indisponivel!"];

        }catch (\Exception $exception){

            Log::info(json_encode(['error' => true, 'message' => $exception->getMessage()]));
            return ['error' => true, 'message' => "Problemas na integração"];

        }
    }


}
