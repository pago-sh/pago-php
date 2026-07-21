<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Create a subscription for an existing customer identified by an external ID.
 */
final class SubscriptionCreateExternalCustomer implements Model, Deserializable
{
    public function __construct(
        public readonly string $product_id,
        public readonly string $external_customer_id,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $product_id = Json::toString(Json::get($data, 'product_id'));
        $external_customer_id = Json::toString(Json::get($data, 'external_customer_id'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;

        return new self(
            product_id: $product_id,
            external_customer_id: $external_customer_id,
            metadata: $metadata,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['product_id'] = Json::encode($this->product_id);
        $data['external_customer_id'] = Json::encode($this->external_customer_id);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
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