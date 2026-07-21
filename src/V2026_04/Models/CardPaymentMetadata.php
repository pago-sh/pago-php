<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Additional metadata for a card payment method.
 */
final class CardPaymentMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $brand,
        public readonly string $last4,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $brand = Json::toString(Json::get($data, 'brand'));
        $last4 = Json::toString(Json::get($data, 'last4'));

        return new self(
            brand: $brand,
            last4: $last4,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['brand'] = Json::encode($this->brand);
        $data['last4'] = Json::encode($this->last4);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}