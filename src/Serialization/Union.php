<?php

declare(strict_types=1);

namespace Pago\Serialization;

use Pago\Contracts\Deserializable;
use Pago\Exception\PagoSerializationException;
use TypeError;
use ValueError;

/**
 * Runtime dispatch for union-typed payloads.
 *
 * When the OpenAPI schema declares a discriminator the variant is selected in
 * constant time from the mapping. Otherwise each candidate is tried in
 * declaration order and the first one that decodes without error wins, which
 * is the same "smart union" behaviour Pydantic applies on the server side.
 */
final class Union
{
    /**
     * @param array<string, class-string<Deserializable>> $mapping
     * @param list<class-string<Deserializable>>          $candidates
     */
    public static function resolve(
        mixed $data,
        ?string $discriminator,
        array $mapping,
        array $candidates,
    ): mixed {
        if (!is_array($data)) {
            return $data;
        }

        $map = Json::toMap($data);

        if ($discriminator !== null) {
            $tag = $map[$discriminator] ?? null;
            if (is_string($tag) && isset($mapping[$tag])) {
                return $mapping[$tag]::fromArray($map);
            }
        }

        foreach ($candidates as $candidate) {
            try {
                return $candidate::fromArray($map);
            } catch (PagoSerializationException | TypeError | ValueError) {
                continue;
            }
        }

        if ($candidates === []) {
            return $data;
        }

        throw new PagoSerializationException(
            'No union variant matched the payload. Tried: ' . implode(', ', $candidates) . '.',
        );
    }
}