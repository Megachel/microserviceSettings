<?php

namespace App\Service\Microservice;

use App\Dto\Setting\SettingType;
use App\Service\GrpcClient\BravoClient;

class MicroserviceConfig
{
    private array $config;

    public function __construct()
    {
        $this->config['alpha'] = [
            'type' => MicroserviceType::REST,
            'endpoint' => 'http://alpha.company.local/settings',
            'fields' => [
                'field1' => SettingType::STRING,
                'field2' => SettingType::BOOL,
                'field3' => SettingType::LIST_OF_STRINGS,
            ]
        ];
        $this->config['bravo'] = [
            'type' => MicroserviceType::gRPC,
            'host' => 'bravo.company.local:50051',
            'client' => BravoClient::class,
            'fields' => [
                'field1' => SettingType::STRING,
                'field2' => SettingType::BOOL,
                'field3' => SettingType::INT,
            ]
        ];
        $this->config['charly'] = [
            'type' => MicroserviceType::HTTP,
            'endpoint' => 'http://charly.company.local/settings',
            'fields' => [
                'field1' => SettingType::BOOL,
                'field2' => SettingType::INT,
                'field3' => SettingType::ARRAY_OF_INTS_STRING_KEYS,
            ]
        ];
    }

    public function validate(): bool
    {
        return true;
    }

    // @TODO: по хорошему бы конфиг каждого микросервиса инкапсулировать в DTO
    public function getMicroserviceConfig(string $name): array
    {
        if (!isset($this->config[$name])) {
            throw new MicroserviceNotFoundException(sprintf('Microservice "%s" not found', $name));
        }
        return $this->config[$name];
    }

    public function listMicroservices(): array
    {
        return array_keys($this->config);
    }
}