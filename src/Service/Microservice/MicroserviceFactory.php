<?php

namespace App\Service\Microservice;


use App\Service\Microservice\Type\GrpcMicroservice;
use App\Service\Microservice\Type\HttpMicroservice;
use App\Service\Microservice\Type\MicroserviceTypeInterface;
use App\Service\Microservice\Type\RestMicroservice;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MicroserviceFactory
{
    public function __construct(
        private readonly MicroserviceConfig $config,
        private readonly HttpClientInterface $httpClient,
    )
    {
    }

    public function getMicroservice(string $name): MicroserviceTypeInterface
    {
        $config = $this->config->getMicroserviceConfig($name);

//        dd($config);
        switch ($config['type']){
            case MicroserviceType::REST: return new RestMicroservice($this->httpClient, $config['endpoint'], $config['fields']);
            case MicroserviceType::HTTP: return new HttpMicroservice($this->httpClient, $config['endpoint'], $config['fields']);
            case MicroserviceType::gRPC: return new GrpcMicroservice($config['host'], $config['client'], $config['fields']);
        }

        throw new MicroserviceNotFoundException(sprintf('Microservice type "%s" with name "%s" not found', $config['type']->name, $name));
    }
}