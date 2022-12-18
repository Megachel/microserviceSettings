<?php

namespace App\Service\Microservice\Type;

use App\Dto\Setting\SettingsCollection;

interface MicroserviceTypeInterface
{
    public function getSettings(): SettingsCollection;

//    public function getSetting(string $key);

//    public function setSetting(string $key, mixed $value);
}