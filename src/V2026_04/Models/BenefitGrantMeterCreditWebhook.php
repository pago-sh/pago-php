<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantMeterCreditWebhook
 */
final class BenefitGrantMeterCreditWebhook implements Model, Deserializable, BenefitGrantWebhook
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly bool $is_granted,
        public readonly bool $is_revoked,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id,
        /**
         * @var string|null
         */
        public readonly ?string $order_id,
        public readonly string $customer_id,
        public readonly string $benefit_id,
        public readonly Customer $customer,
        public readonly BenefitMeterCredit $benefit,
        public readonly BenefitGrantMeterCreditProperties $properties,
        /**
         * @var string|null
         */
        public readonly ?string $granted_at = null,
        /**
         * @var string|null
         */
        public readonly ?string $revoked_at = null,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
        /**
         * @var BenefitGrantError|null
         */
        public readonly ?BenefitGrantError $error = null,
        /**
         * @var Member|null
         */
        public readonly ?Member $member = null,
        /**
         * @var BenefitGrantMeterCreditProperties|null
         */
        public readonly ?BenefitGrantMeterCreditProperties $previous_properties = null,
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
        $is_granted = Json::toBool(Json::get($data, 'is_granted'));
        $is_revoked = Json::toBool(Json::get($data, 'is_revoked'));
        /** @var string|null $subscription_id */
        $subscription_id = (Json::get($data, 'subscription_id') === null ? null : Json::toString(Json::get($data, 'subscription_id')));
        /** @var string|null $order_id */
        $order_id = (Json::get($data, 'order_id') === null ? null : Json::toString(Json::get($data, 'order_id')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $benefit_id = Json::toString(Json::get($data, 'benefit_id'));
        $customer = CustomerFactory::fromArray(Json::toMap(Json::get($data, 'customer')));
        $benefit = BenefitMeterCredit::fromArray(Json::toMap(Json::get($data, 'benefit')));
        $properties = BenefitGrantMeterCreditProperties::fromArray(Json::toMap(Json::get($data, 'properties')));
        /** @var string|null $granted_at */
        $granted_at = isset($data['granted_at']) ? Json::toString($data['granted_at']) : null;
        /** @var string|null $revoked_at */
        $revoked_at = isset($data['revoked_at']) ? Json::toString($data['revoked_at']) : null;
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;
        /** @var BenefitGrantError|null $error */
        $error = isset($data['error']) ? BenefitGrantError::fromArray(Json::toMap($data['error'])) : null;
        /** @var Member|null $member */
        $member = isset($data['member']) ? Member::fromArray(Json::toMap($data['member'])) : null;
        /** @var BenefitGrantMeterCreditProperties|null $previous_properties */
        $previous_properties = isset($data['previous_properties']) ? BenefitGrantMeterCreditProperties::fromArray(Json::toMap($data['previous_properties'])) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            is_granted: $is_granted,
            is_revoked: $is_revoked,
            subscription_id: $subscription_id,
            order_id: $order_id,
            customer_id: $customer_id,
            benefit_id: $benefit_id,
            customer: $customer,
            benefit: $benefit,
            properties: $properties,
            granted_at: $granted_at,
            revoked_at: $revoked_at,
            member_id: $member_id,
            error: $error,
            member: $member,
            previous_properties: $previous_properties,
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
        $data['is_granted'] = Json::encode($this->is_granted);
        $data['is_revoked'] = Json::encode($this->is_revoked);
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['order_id'] = Json::encode($this->order_id);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['benefit_id'] = Json::encode($this->benefit_id);
        $data['customer'] = Json::encode($this->customer);
        $data['benefit'] = Json::encode($this->benefit);
        $data['properties'] = Json::encode($this->properties);
        if ($this->granted_at !== null) {
            $data['granted_at'] = Json::encode($this->granted_at);
        }
        if ($this->revoked_at !== null) {
            $data['revoked_at'] = Json::encode($this->revoked_at);
        }
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
        }
        if ($this->error !== null) {
            $data['error'] = Json::encode($this->error);
        }
        if ($this->member !== null) {
            $data['member'] = Json::encode($this->member);
        }
        if ($this->previous_properties !== null) {
            $data['previous_properties'] = Json::encode($this->previous_properties);
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