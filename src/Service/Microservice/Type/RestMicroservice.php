<?php

namespace App\Service\Microservice\Type;

use App\Dto\Setting\SettingsCollection;
use App\Dto\Setting\SettingsCollectionBuilder;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RestMicroservice implements MicroserviceTypeInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private string $endpoint,
        private readonly array $fields,
    )
    {
        if (!filter_var($this->endpoint, FILTER_VALIDATE_URL)) {
            throw new \Exception(sprintf('Wrong endpoint "%s"', $this->endpoint));
        }

        $this->endpoint = 'http://127.0.0.1:8000/rest';
    }

    public function getSettings(): SettingsCollection
    {
        return SettingsCollectionBuilder::build($this->fetchAllSettings(), $this->fields);
    }

    private function fetchAllSettings(): array
    {
        $response = $this->httpClient->request('GET', $this->endpoint);

        try {
            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e){
            return [];
        }
    }
}