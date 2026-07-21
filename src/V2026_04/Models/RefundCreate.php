<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * RefundCreate
 */
final class RefundCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $order_id,
        public readonly Reason $reason,
        public readonly int $amount,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $comment = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $revoke_benefits = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $order_id = Json::toString(Json::get($data, 'order_id'));
        $reason = Reason::from(Json::toString(Json::get($data, 'reason')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $comment */
        $comment = isset($data['comment']) ? Json::toString($data['comment']) : null;
        /** @var bool|null $revoke_benefits */
        $revoke_benefits = isset($data['revoke_benefits']) ? Json::toBool($data['revoke_benefits']) : null;

        return new self(
            order_id: $order_id,
            reason: $reason,
            amount: $amount,
            metadata: $metadata,
            comment: $comment,
            revoke_benefits: $revoke_benefits,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['order_id'] = Json::encode($this->order_id);
        $data['reason'] = Json::encode($this->reason);
        $data['amount'] = Json::encode($this->amount);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->comment !== null) {
            $data['comment'] = Json::encode($this->comment);
        }
        if ($this->revoke_benefits !== null) {
            $data['revoke_benefits'] = Json::encode($this->revoke_benefits);
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