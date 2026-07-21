<?php

declare(strict_types=1);

namespace Pago\Serialization;

use BackedEnum;
use JsonException;
use Pago\Contracts\Model;
use Pago\Exception\PagoSerializationException;

/**
 * Narrowing helpers used by generated `fromArray()` implementations, plus the
 * generic encoder used by `toArray()`.
 */
final class Json
{
    /**
     * Read a key from a decoded JSON object, or `null` when it is absent.
     *
     * Generated code goes through this instead of `$data['key'] ?? null` so
     * that a payload missing a documented key degrades into a typed
     * {@see PagoSerializationException} rather than a PHP warning.
     *
     * @param array<string, mixed> $data
     */
    public static function get(array $data, string $key): mixed
    {
        return array_key_exists($key, $data) ? $data[$key] : null;
    }

    public static function toString(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        throw self::unexpected('string', $value);
    }

    public static function toInt(mixed $value): int
    {
        if (is_int($value)) {
            return $value;
        }
        // JSON has a single number type: an integral float is a valid integer.
        if (is_float($value) && floor($value) === $value && is_finite($value)) {
            return (int) $value;
        }

        throw self::unexpected('int', $value);
    }

    public static function toFloat(mixed $value): float
    {
        if (is_float($value)) {
            return $value;
        }
        if (is_int($value)) {
            return (float) $value;
        }

        throw self::unexpected('float', $value);
    }

    public static function toBool(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        throw self::unexpected('bool', $value);
    }

    /**
     * @return list<mixed>
     */
    public static function toList(mixed $value): array
    {
        if (is_array($value) && array_is_list($value)) {
            return $value;
        }

        throw self::unexpected('list', $value);
    }

    /**
     * @return array<string, mixed>
     */
    public static function toMap(mixed $value): array
    {
        if (!is_array($value)) {
            throw self::unexpected('object', $value);
        }

        $result = [];
        foreach ($value as $key => $item) {
            $result[(string) $key] = $item;
        }

        return $result;
    }

    /**
     * Recursively convert models, enums and arrays into JSON-ready values.
     */
    public static function encode(mixed $value): mixed
    {
        if ($value instanceof Model) {
            return $value->toArray();
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = self::encode($item);
            }

            return $result;
        }

        return $value;
    }

    /**
     * Decode a JSON document, raising a Pago exception on malformed input.
     */
    public static function decode(string $payload): mixed
    {
        try {
            return json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new PagoSerializationException(
                'Failed to decode JSON payload: ' . $exception->getMessage(),
                previous: $exception,
            );
        }
    }

    public static function stringify(mixed $value): string
    {
        try {
            return json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        } catch (JsonException $exception) {
            throw new PagoSerializationException(
                'Failed to encode JSON payload: ' . $exception->getMessage(),
                previous: $exception,
            );
        }
    }

    private static function unexpected(string $expected, mixed $value): PagoSerializationException
    {
        return new PagoSerializationException(
            sprintf('Expected %s, got %s.', $expected, get_debug_type($value)),
        );
    }
}