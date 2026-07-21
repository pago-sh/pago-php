<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Feature flags exposed to the customer portal.
 */
final class CustomerOrganizationFeatureSettings implements Model, Deserializable
{
    public function __construct(
        /**
         * @var bool|null
         */
        public readonly ?bool $member_model_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $checkout_localization_enabled = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var bool|null $member_model_enabled */
        $member_model_enabled = isset($data['member_model_enabled']) ? Json::toBool($data['member_model_enabled']) : null;
        /** @var bool|null $checkout_localization_enabled */
        $checkout_localization_enabled = isset($data['checkout_localization_enabled']) ? Json::toBool($data['checkout_localization_enabled']) : null;

        return new self(
            member_model_enabled: $member_model_enabled,
            checkout_localization_enabled: $checkout_localization_enabled,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->member_model_enabled !== null) {
            $data['member_model_enabled'] = Json::encode($this->member_model_enabled);
        }
        if ($this->checkout_localization_enabled !== null) {
            $data['checkout_localization_enabled'] = Json::encode($this->checkout_localization_enabled);
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