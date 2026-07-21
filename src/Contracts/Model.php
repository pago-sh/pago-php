<?php

declare(strict_types=1);

namespace Pago\Contracts;

use JsonSerializable;

/**
 * A value object that maps one-to-one onto a JSON object from the Pago API.
 */
interface Model extends JsonSerializable
{
    /**
     * Convert the model back into its JSON representation.
     *
     * Optional properties that are `null` are omitted so that a partial update
     * never unsets a field the caller did not touch.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;
}