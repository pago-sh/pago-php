<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a draft order for an off-session charge.
 */
final class OrderCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $customer_id,
        public readonly string $product_id,
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $currency = null,
        /**
         * @var int|null
         */
        public readonly ?int $amount = null,
        /**
         * @var string|null
         */
        public readonly ?string $description = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var string|null $currency */
        $currency = isset($data['currency']) ? Json::toString($data['currency']) : null;
        /** @var int|null $amount */
        $amount = isset($data['amount']) ? Json::toInt($data['amount']) : null;
        /** @var string|null $description */
        $description = isset($data['description']) ? Json::toString($data['description']) : null;

        return new self(
            customer_id: $customer_id,
            product_id: $product_id,
            custom_field_data: $custom_field_data,
            metadata: $metadata,
            organization_id: $organization_id,
            currency: $currency,
            amount: $amount,
            description: $description,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['product_id'] = Json::encode($this->product_id);
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
        }
        if ($this->amount !== null) {
            $data['amount'] = Json::encode($this->amount);
        }
        if ($this->description !== null) {
            $data['description'] = Json::encode($this->description);
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