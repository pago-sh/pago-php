<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema of a payment with a card payment method.
 */
final class CardPayment implements Model, Deserializable, Payment
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly PaymentProcessor $processor,
        public readonly PaymentStatus $status,
        public readonly int $amount,
        public readonly string $currency,
        public readonly string $method,
        /**
         * @var PaymentTrigger|null
         */
        public readonly ?PaymentTrigger $trigger,
        /**
         * @var string|null
         */
        public readonly ?string $decline_reason,
        /**
         * @var string|null
         */
        public readonly ?string $decline_message,
        public readonly string $organization_id,
        /**
         * @var string|null
         */
        public readonly ?string $checkout_id,
        /**
         * @var string|null
         */
        public readonly ?string $order_id,
        public readonly CardPaymentMetadata $method_metadata,
        /**
         * @var array<string, mixed>|null
         */
        public readonly ?array $processor_metadata = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $processor = PaymentProcessor::from(Json::toString(Json::get($data, 'processor')));
        $status = PaymentStatus::from(Json::toString(Json::get($data, 'status')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $method = Json::toString(Json::get($data, 'method'));
        /** @var PaymentTrigger|null $trigger */
        $trigger = (Json::get($data, 'trigger') === null ? null : PaymentTrigger::from(Json::toString(Json::get($data, 'trigger'))));
        /** @var string|null $decline_reason */
        $decline_reason = (Json::get($data, 'decline_reason') === null ? null : Json::toString(Json::get($data, 'decline_reason')));
        /** @var string|null $decline_message */
        $decline_message = (Json::get($data, 'decline_message') === null ? null : Json::toString(Json::get($data, 'decline_message')));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $checkout_id */
        $checkout_id = (Json::get($data, 'checkout_id') === null ? null : Json::toString(Json::get($data, 'checkout_id')));
        /** @var string|null $order_id */
        $order_id = (Json::get($data, 'order_id') === null ? null : Json::toString(Json::get($data, 'order_id')));
        $method_metadata = CardPaymentMetadata::fromArray(Json::toMap(Json::get($data, 'method_metadata')));
        /** @var array<string, mixed>|null $processor_metadata */
        $processor_metadata = isset($data['processor_metadata']) ? Json::toMap($data['processor_metadata']) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            processor: $processor,
            status: $status,
            amount: $amount,
            currency: $currency,
            method: $method,
            trigger: $trigger,
            decline_reason: $decline_reason,
            decline_message: $decline_message,
            organization_id: $organization_id,
            checkout_id: $checkout_id,
            order_id: $order_id,
            method_metadata: $method_metadata,
            processor_metadata: $processor_metadata,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['processor'] = Json::encode($this->processor);
        $data['status'] = Json::encode($this->status);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['method'] = Json::encode($this->method);
        $data['trigger'] = Json::encode($this->trigger);
        $data['decline_reason'] = Json::encode($this->decline_reason);
        $data['decline_message'] = Json::encode($this->decline_message);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['checkout_id'] = Json::encode($this->checkout_id);
        $data['order_id'] = Json::encode($this->order_id);
        $data['method_metadata'] = Json::encode($this->method_metadata);
        if ($this->processor_metadata !== null) {
            $data['processor_metadata'] = Json::encode($this->processor_metadata);
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