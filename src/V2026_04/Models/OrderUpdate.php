<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update an order.
 */
final class OrderUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $billing_name = null,
        /**
         * @var AddressInput|null
         */
        public readonly ?AddressInput $billing_address = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $billing_name */
        $billing_name = isset($data['billing_name']) ? Json::toString($data['billing_name']) : null;
        /** @var AddressInput|null $billing_address */
        $billing_address = isset($data['billing_address']) ? AddressInput::fromArray(Json::toMap($data['billing_address'])) : null;

        return new self(
            billing_name: $billing_name,
            billing_address: $billing_address,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->billing_name !== null) {
            $data['billing_name'] = Json::encode($this->billing_name);
        }
        if ($this->billing_address !== null) {
            $data['billing_address'] = Json::encode($this->billing_address);
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