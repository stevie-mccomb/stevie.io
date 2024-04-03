<?php

if (!function_exists('is_json')) {
    function is_json(mixed $value): bool
    {
        try {
            json_decode($value);
            return json_last_error() === JSON_ERROR_NONE;
        } catch (\Throwable $e) {
            return false;
        }
    }
}

if (!function_exists('is_jsonable')) {
    function is_jsonable(mixed $value): bool
    {
        try {
            json_encode($value);
            return json_last_error() === JSON_ERROR_NONE;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
