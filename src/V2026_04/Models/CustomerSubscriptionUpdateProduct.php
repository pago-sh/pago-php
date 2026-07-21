<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSubscriptionUpdateProduct
 */
final class CustomerSubscriptionUpdateProduct implements Model, Deserializable, CustomerSubscriptionUpdate
{
    public function __construct(
        public readonly string $product_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $product_id = Json::toString(Json::get($data, 'product_id'));

        return new self(
            product_id: $product_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['product_id'] = Json::encode($this->product_id);

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