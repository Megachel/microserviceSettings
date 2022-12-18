<?php

namespace App\Dto\Setting;

class SettingsCollection
{
    private array $settings = [];

    public function __construct()
    {
    }

    public function set(string $field, mixed $value): bool
    {
        $this->settings[$field] = $value;

        return true;
    }

    public function getAll(): array
    {
        return $this->settings;
    }

    public function getSetting(string $field): mixed
    {
        return $this->settings[$field] ?? null;
    }

    public function removeElement($element): bool
    {
        $key = array_search($element, $this->settings, true);

        if ($key === false) {
            return false;
        }

        unset($this->settings[$key]);

        return true;
    }

}