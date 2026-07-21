<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitLicenseKeysCreateProperties
 */
final class BenefitLicenseKeysCreateProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $prefix = null,
        /**
         * @var BenefitLicenseKeyExpirationProperties|null
         */
        public readonly ?BenefitLicenseKeyExpirationProperties $expires = null,
        /**
         * @var BenefitLicenseKeyActivationCreateProperties|null
         */
        public readonly ?BenefitLicenseKeyActivationCreateProperties $activations = null,
        /**
         * @var int|null
         */
        public readonly ?int $limit_usage = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $prefix */
        $prefix = isset($data['prefix']) ? Json::toString($data['prefix']) : null;
        /** @var BenefitLicenseKeyExpirationProperties|null $expires */
        $expires = isset($data['expires']) ? BenefitLicenseKeyExpirationProperties::fromArray(Json::toMap($data['expires'])) : null;
        /** @var BenefitLicenseKeyActivationCreateProperties|null $activations */
        $activations = isset($data['activations']) ? BenefitLicenseKeyActivationCreateProperties::fromArray(Json::toMap($data['activations'])) : null;
        /** @var int|null $limit_usage */
        $limit_usage = isset($data['limit_usage']) ? Json::toInt($data['limit_usage']) : null;

        return new self(
            prefix: $prefix,
            expires: $expires,
            activations: $activations,
            limit_usage: $limit_usage,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->prefix !== null) {
            $data['prefix'] = Json::encode($this->prefix);
        }
        if ($this->expires !== null) {
            $data['expires'] = Json::encode($this->expires);
        }
        if ($this->activations !== null) {
            $data['activations'] = Json::encode($this->activations);
        }
        if ($this->limit_usage !== null) {
            $data['limit_usage'] = Json::encode($this->limit_usage);
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