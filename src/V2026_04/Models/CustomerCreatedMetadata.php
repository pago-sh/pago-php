<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerCreatedMetadata
 */
final class CustomerCreatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $customer_email,
        /**
         * @var string|null
         */
        public readonly ?string $customer_name,
        /**
         * @var string|null
         */
        public readonly ?string $customer_external_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        /** @var string|null $customer_email */
        $customer_email = (Json::get($data, 'customer_email') === null ? null : Json::toString(Json::get($data, 'customer_email')));
        /** @var string|null $customer_name */
        $customer_name = (Json::get($data, 'customer_name') === null ? null : Json::toString(Json::get($data, 'customer_name')));
        /** @var string|null $customer_external_id */
        $customer_external_id = (Json::get($data, 'customer_external_id') === null ? null : Json::toString(Json::get($data, 'customer_external_id')));

        return new self(
            customer_id: $customer_id,
            customer_email: $customer_email,
            customer_name: $customer_name,
            customer_external_id: $customer_external_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['customer_email'] = Json::encode($this->customer_email);
        $data['customer_name'] = Json::encode($this->customer_name);
        $data['customer_external_id'] = Json::encode($this->customer_external_id);

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