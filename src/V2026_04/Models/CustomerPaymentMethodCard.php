<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPaymentMethodCard
 */
final class CustomerPaymentMethodCard implements Model, Deserializable, PaymentMethod
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly PaymentProcessor $processor,
        public readonly string $customer_id,
        public readonly string $type,
        public readonly PaymentMethodCardMetadata $method_metadata,
        public readonly bool $is_default,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $processor = PaymentProcessor::from(Json::toString(Json::get($data, 'processor')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $type = Json::toString(Json::get($data, 'type'));
        $method_metadata = PaymentMethodCardMetadata::fromArray(Json::toMap(Json::get($data, 'method_metadata')));
        $is_default = Json::toBool(Json::get($data, 'is_default'));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            processor: $processor,
            customer_id: $customer_id,
            type: $type,
            method_metadata: $method_metadata,
            is_default: $is_default,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['processor'] = Json::encode($this->processor);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['type'] = Json::encode($this->type);
        $data['method_metadata'] = Json::encode($this->method_metadata);
        $data['is_default'] = Json::encode($this->is_default);

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