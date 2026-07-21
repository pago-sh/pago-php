<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSubscriptionCancel
 */
final class CustomerSubscriptionCancel implements Model, Deserializable, CustomerSubscriptionUpdate
{
    public function __construct(
        /**
         * @var bool|null
         */
        public readonly ?bool $cancel_at_period_end = null,
        /**
         * @var CustomerCancellationReason|null
         */
        public readonly ?CustomerCancellationReason $cancellation_reason = null,
        /**
         * @var string|null
         */
        public readonly ?string $cancellation_comment = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var bool|null $cancel_at_period_end */
        $cancel_at_period_end = isset($data['cancel_at_period_end']) ? Json::toBool($data['cancel_at_period_end']) : null;
        /** @var CustomerCancellationReason|null $cancellation_reason */
        $cancellation_reason = isset($data['cancellation_reason']) ? CustomerCancellationReason::from(Json::toString($data['cancellation_reason'])) : null;
        /** @var string|null $cancellation_comment */
        $cancellation_comment = isset($data['cancellation_comment']) ? Json::toString($data['cancellation_comment']) : null;

        return new self(
            cancel_at_period_end: $cancel_at_period_end,
            cancellation_reason: $cancellation_reason,
            cancellation_comment: $cancellation_comment,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->cancel_at_period_end !== null) {
            $data['cancel_at_period_end'] = Json::encode($this->cancel_at_period_end);
        }
        if ($this->cancellation_reason !== null) {
            $data['cancellation_reason'] = Json::encode($this->cancellation_reason);
        }
        if ($this->cancellation_comment !== null) {
            $data['cancellation_comment'] = Json::encode($this->cancellation_comment);
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