<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * ValidatedLicenseKey
 */
final class ValidatedLicenseKey implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $organization_id,
        public readonly string $customer_id,
        public readonly LicenseKeyCustomer $customer,
        public readonly string $benefit_id,
        public readonly string $key,
        public readonly string $display_key,
        public readonly LicenseKeyStatus $status,
        /**
         * @var int|null
         */
        public readonly ?int $limit_activations,
        public readonly int $usage,
        /**
         * @var int|null
         */
        public readonly ?int $limit_usage,
        public readonly int $validations,
        /**
         * @var string|null
         */
        public readonly ?string $last_validated_at,
        /**
         * @var string|null
         */
        public readonly ?string $expires_at,
        /**
         * @var LicenseKeyActivationBase|null
         */
        public readonly ?LicenseKeyActivationBase $activation = null,
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
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $customer = LicenseKeyCustomer::fromArray(Json::toMap(Json::get($data, 'customer')));
        $benefit_id = Json::toString(Json::get($data, 'benefit_id'));
        $key = Json::toString(Json::get($data, 'key'));
        $display_key = Json::toString(Json::get($data, 'display_key'));
        $status = LicenseKeyStatus::from(Json::toString(Json::get($data, 'status')));
        /** @var int|null $limit_activations */
        $limit_activations = (Json::get($data, 'limit_activations') === null ? null : Json::toInt(Json::get($data, 'limit_activations')));
        $usage = Json::toInt(Json::get($data, 'usage'));
        /** @var int|null $limit_usage */
        $limit_usage = (Json::get($data, 'limit_usage') === null ? null : Json::toInt(Json::get($data, 'limit_usage')));
        $validations = Json::toInt(Json::get($data, 'validations'));
        /** @var string|null $last_validated_at */
        $last_validated_at = (Json::get($data, 'last_validated_at') === null ? null : Json::toString(Json::get($data, 'last_validated_at')));
        /** @var string|null $expires_at */
        $expires_at = (Json::get($data, 'expires_at') === null ? null : Json::toString(Json::get($data, 'expires_at')));
        /** @var LicenseKeyActivationBase|null $activation */
        $activation = isset($data['activation']) ? LicenseKeyActivationBase::fromArray(Json::toMap($data['activation'])) : null;

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            organization_id: $organization_id,
            customer_id: $customer_id,
            customer: $customer,
            benefit_id: $benefit_id,
            key: $key,
            display_key: $display_key,
            status: $status,
            limit_activations: $limit_activations,
            usage: $usage,
            limit_usage: $limit_usage,
            validations: $validations,
            last_validated_at: $last_validated_at,
            expires_at: $expires_at,
            activation: $activation,
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
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['customer'] = Json::encode($this->customer);
        $data['benefit_id'] = Json::encode($this->benefit_id);
        $data['key'] = Json::encode($this->key);
        $data['display_key'] = Json::encode($this->display_key);
        $data['status'] = Json::encode($this->status);
        $data['limit_activations'] = Json::encode($this->limit_activations);
        $data['usage'] = Json::encode($this->usage);
        $data['limit_usage'] = Json::encode($this->limit_usage);
        $data['validations'] = Json::encode($this->validations);
        $data['last_validated_at'] = Json::encode($this->last_validated_at);
        $data['expires_at'] = Json::encode($this->expires_at);
        if ($this->activation !== null) {
            $data['activation'] = Json::encode($this->activation);
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