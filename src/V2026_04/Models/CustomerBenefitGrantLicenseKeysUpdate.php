<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerBenefitGrantLicenseKeysUpdate
 */
final class CustomerBenefitGrantLicenseKeysUpdate implements Model, Deserializable, CustomerBenefitGrantUpdate
{
    public function __construct(
        public readonly string $benefit_type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $benefit_type = Json::toString(Json::get($data, 'benefit_type'));

        return new self(
            benefit_type: $benefit_type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['benefit_type'] = Json::encode($this->benefit_type);

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