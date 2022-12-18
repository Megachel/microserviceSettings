<?php

namespace App\Dto\Setting;

class SettingsDynamicCollectionBuilder
{
    static function build(array $array, array $mapping): SettingsCollection
    {
        $settings = new SettingsCollection();

        foreach ($mapping as $name => $type) {
            if (!isset($array[$name]) || !self::validate($array[$name], $type)) {
                continue;
            }
            $settings->set($name, self::convert($array[$name], $type));
        }
        return $settings;
    }

    static private function validate(mixed $value, SettingType $type): bool
    {
        switch ($type) {
            case SettingType::STRING:
                if (is_scalar($value)) {
                    return true;
                };
                break;

            case SettingType::INT:
                // no break
            case SettingType::BOOL:
                return true;

            case SettingType::ARRAY_OF_INTS_STRING_KEYS:
                // no break
            case SettingType::LIST_OF_STRINGS:
                foreach ($value as $element) {
                    if (!is_scalar($element)) {
                        return false;
                    }
                }
                return true;
        }
        return false;
    }

    static private function convert(mixed $value, SettingType $type): mixed
    {
        switch ($type) {
            case SettingType::STRING:
                return (string)$value;

            case SettingType::INT:
                return (int)$value;

            case SettingType::BOOL:
                return (bool)$value;

            case SettingType::ARRAY_OF_INTS_STRING_KEYS:
                $result = [];
                foreach ($value as $key => $el) {
                    $result[(string)$key] = (int)$el;
                };
                return $result;
            case SettingType::LIST_OF_STRINGS:
                return array_map(fn ($el): string => strval($el), array_values($value));

        }

        return null;
    }
}