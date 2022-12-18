<?php

namespace App\Service\Microservice\Type;

use App\Dto\Setting\SettingsCollection;
use App\Dto\Setting\SettingsCollectionBuilder;
use App\Service\GrpcClient\BravoClient;
use \Grpc\BaseStub;
use \Grpc\ChannelCredentials;

class GrpcMicroservice implements MicroserviceTypeInterface
{
    private BaseStub $client;

    public function __construct(
        string $host,
        string $clientClass,
        private readonly array $fields,
    )
    {
        $this->client = new $clientClass($host, [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }

    public function getSettings(): SettingsCollection
    {
        return SettingsCollectionBuilder::build($this->fetchAllSettings(), $this->fields);
    }

    private function fetchAllSettings(): array
    {
        return [];
    }
}