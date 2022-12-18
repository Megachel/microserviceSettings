<?php

namespace App\Dto\Setting;

class SettingsCollectionBuilder
{
    static function build(array $array, array $mapping): SettingsCollection
    {
        $settings = new SettingsCollection();

        foreach ($mapping as $name => $type) {
            if (!isset($array[$name]) || !self::validate($type, $array[$name])) {
                continue;
            }
            $settings->set($name, $array[$name]);
        }
        return $settings;
    }

    static private function validate(mixed $value, SettingType $type): bool
    {
        switch ($type) {
            case SettingType::STRING:
                if (is_string($value)) {
                    return true;
                };
                break;

            case SettingType::INT:
                if (is_int($value)) {
                    return true;
                };
                break;

            case SettingType::BOOL:
                if (is_bool($value)) {
                    return true;
                };
                break;

            case SettingType::LIST_OF_STRINGS:
                if (!array_is_list($value)) {
                    return false;
                }
                foreach ($value as $element) {
                    if (!is_string($element)) {
                        return false;
                    }
                }
                return true;
            case SettingType::ARRAY_OF_INTS_STRING_KEYS:
                throw new \Exception('To be implemented');
        }
        return false;
    }
}