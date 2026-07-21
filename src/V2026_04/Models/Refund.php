<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Refund
 */
final class Refund implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly RefundStatus $status,
        public readonly RefundReason $reason,
        public readonly int $amount,
        public readonly int $tax_amount,
        public readonly string $currency,
        public readonly string $organization_id,
        public readonly string $order_id,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id,
        public readonly string $customer_id,
        public readonly bool $revoke_benefits,
        /**
         * @var RefundDispute|null
         */
        public readonly ?RefundDispute $dispute,
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
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $status = RefundStatus::from(Json::toString(Json::get($data, 'status')));
        $reason = RefundReason::from(Json::toString(Json::get($data, 'reason')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $tax_amount = Json::toInt(Json::get($data, 'tax_amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $order_id = Json::toString(Json::get($data, 'order_id'));
        /** @var string|null $subscription_id */
        $subscription_id = (Json::get($data, 'subscription_id') === null ? null : Json::toString(Json::get($data, 'subscription_id')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $revoke_benefits = Json::toBool(Json::get($data, 'revoke_benefits'));
        /** @var RefundDispute|null $dispute */
        $dispute = (Json::get($data, 'dispute') === null ? null : RefundDispute::fromArray(Json::toMap(Json::get($data, 'dispute'))));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            metadata: $metadata,
            status: $status,
            reason: $reason,
            amount: $amount,
            tax_amount: $tax_amount,
            currency: $currency,
            organization_id: $organization_id,
            order_id: $order_id,
            subscription_id: $subscription_id,
            customer_id: $customer_id,
            revoke_benefits: $revoke_benefits,
            dispute: $dispute,
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
        $data['metadata'] = Json::encode($this->metadata);
        $data['status'] = Json::encode($this->status);
        $data['reason'] = Json::encode($this->reason);
        $data['amount'] = Json::encode($this->amount);
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['currency'] = Json::encode($this->currency);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['order_id'] = Json::encode($this->order_id);
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['revoke_benefits'] = Json::encode($this->revoke_benefits);
        $data['dispute'] = Json::encode($this->dispute);

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