<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitLicenseKeyActivationCreateProperties
 */
final class BenefitLicenseKeyActivationCreateProperties implements Model, Deserializable
{
    public function __construct(
        public readonly int $limit,
        public readonly bool $enable_customer_admin,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $limit = Json::toInt(Json::get($data, 'limit'));
        $enable_customer_admin = Json::toBool(Json::get($data, 'enable_customer_admin'));

        return new self(
            limit: $limit,
            enable_customer_admin: $enable_customer_admin,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['limit'] = Json::encode($this->limit);
        $data['enable_customer_admin'] = Json::encode($this->enable_customer_admin);

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