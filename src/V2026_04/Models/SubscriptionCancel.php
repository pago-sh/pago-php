<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionCancel
 */
final class SubscriptionCancel implements Model, Deserializable, SubscriptionUpdate
{
    public function __construct(
        public readonly bool $cancel_at_period_end,
        /**
         * @var CustomerCancellationReason|null
         */
        public readonly ?CustomerCancellationReason $customer_cancellation_reason = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_cancellation_comment = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $cancel_at_period_end = Json::toBool(Json::get($data, 'cancel_at_period_end'));
        /** @var CustomerCancellationReason|null $customer_cancellation_reason */
        $customer_cancellation_reason = isset($data['customer_cancellation_reason']) ? CustomerCancellationReason::from(Json::toString($data['customer_cancellation_reason'])) : null;
        /** @var string|null $customer_cancellation_comment */
        $customer_cancellation_comment = isset($data['customer_cancellation_comment']) ? Json::toString($data['customer_cancellation_comment']) : null;

        return new self(
            cancel_at_period_end: $cancel_at_period_end,
            customer_cancellation_reason: $customer_cancellation_reason,
            customer_cancellation_comment: $customer_cancellation_comment,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cancel_at_period_end'] = Json::encode($this->cancel_at_period_end);
        if ($this->customer_cancellation_reason !== null) {
            $data['customer_cancellation_reason'] = Json::encode($this->customer_cancellation_reason);
        }
        if ($this->customer_cancellation_comment !== null) {
            $data['customer_cancellation_comment'] = Json::encode($this->customer_cancellation_comment);
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