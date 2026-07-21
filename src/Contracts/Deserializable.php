<?php

declare(strict_types=1);

namespace Pago\Contracts;

/**
 * A type that can be built from a decoded JSON object.
 *
 * The return type is widened to {@see Model} so that both concrete models
 * (which return themselves) and union factories (which return the union
 * interface) can satisfy the contract.
 */
interface Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Model;
}