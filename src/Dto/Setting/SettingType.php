<?php

namespace App\Dto\Setting;

Enum SettingType: string
{
    case INT = 'int';
    case STRING = 'string';
    case BOOL = 'bool';
    case LIST_OF_STRINGS = 'array<string>';
    case ARRAY_OF_INTS_STRING_KEYS = 'array<string, int>';
}