<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema representing a dispute.
 *
 * A dispute is a challenge raised by a customer or their bank regarding a payment.
 */
final class Dispute implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly DisputeStatus $status,
        public readonly bool $resolved,
        public readonly bool $closed,
        public readonly int $amount,
        public readonly int $tax_amount,
        public readonly string $currency,
        /**
         * @var string|null
         */
        public readonly ?string $reason,
        /**
         * @var string|null
         */
        public readonly ?string $evidence_due_by,
        public readonly bool $past_due,
        public readonly string $order_id,
        public readonly string $payment_id,
        public readonly DisputeCustomer $customer,
        /**
         * @var string|null
         */
        public readonly ?string $case_id,
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
        $status = DisputeStatus::from(Json::toString(Json::get($data, 'status')));
        $resolved = Json::toBool(Json::get($data, 'resolved'));
        $closed = Json::toBool(Json::get($data, 'closed'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $tax_amount = Json::toInt(Json::get($data, 'tax_amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        /** @var string|null $reason */
        $reason = (Json::get($data, 'reason') === null ? null : Json::toString(Json::get($data, 'reason')));
        /** @var string|null $evidence_due_by */
        $evidence_due_by = (Json::get($data, 'evidence_due_by') === null ? null : Json::toString(Json::get($data, 'evidence_due_by')));
        $past_due = Json::toBool(Json::get($data, 'past_due'));
        $order_id = Json::toString(Json::get($data, 'order_id'));
        $payment_id = Json::toString(Json::get($data, 'payment_id'));
        $customer = DisputeCustomer::fromArray(Json::toMap(Json::get($data, 'customer')));
        /** @var string|null $case_id */
        $case_id = (Json::get($data, 'case_id') === null ? null : Json::toString(Json::get($data, 'case_id')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            status: $status,
            resolved: $resolved,
            closed: $closed,
            amount: $amount,
            tax_amount: $tax_amount,
            currency: $currency,
            reason: $reason,
            evidence_due_by: $evidence_due_by,
            past_due: $past_due,
            order_id: $order_id,
            payment_id: $payment_id,
            customer: $customer,
            case_id: $case_id,
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
        $data['status'] = Json::encode($this->status);
        $data['resolved'] = Json::encode($this->resolved);
        $data['closed'] = Json::encode($this->closed);
        $data['amount'] = Json::encode($this->amount);
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['currency'] = Json::encode($this->currency);
        $data['reason'] = Json::encode($this->reason);
        $data['evidence_due_by'] = Json::encode($this->evidence_due_by);
        $data['past_due'] = Json::encode($this->past_due);
        $data['order_id'] = Json::encode($this->order_id);
        $data['payment_id'] = Json::encode($this->payment_id);
        $data['customer'] = Json::encode($this->customer);
        $data['case_id'] = Json::encode($this->case_id);

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