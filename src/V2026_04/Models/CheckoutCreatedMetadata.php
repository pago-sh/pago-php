<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CheckoutCreatedMetadata
 */
final class CheckoutCreatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $checkout_id,
        public readonly string $checkout_status,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $checkout_id = Json::toString(Json::get($data, 'checkout_id'));
        $checkout_status = Json::toString(Json::get($data, 'checkout_status'));
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;

        return new self(
            checkout_id: $checkout_id,
            checkout_status: $checkout_status,
            product_id: $product_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['checkout_id'] = Json::encode($this->checkout_id);
        $data['checkout_status'] = Json::encode($this->checkout_status);
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }

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