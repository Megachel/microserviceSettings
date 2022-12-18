<?php

namespace App\Service\Microservice\Type;

use App\Dto\Setting\SettingsCollection;
use App\Dto\Setting\SettingsCollectionBuilder;
use App\Dto\Setting\SettingsDynamicCollectionBuilder;
use App\Service\Microservice\DataSource\DataSourceInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpMicroservice implements MicroserviceTypeInterface
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

        $this->endpoint = 'http://127.0.0.1:8000/http';
    }

    public function getSettings(): SettingsCollection
    {
        return SettingsDynamicCollectionBuilder::build($this->fetchAllSettings(), $this->fields);
    }

    private function fetchAllSettings(): array
    {
        $response = $this->httpClient->request('GET', $this->endpoint);

        parse_str($response->getContent(), $result);

        return $result;
    }

}