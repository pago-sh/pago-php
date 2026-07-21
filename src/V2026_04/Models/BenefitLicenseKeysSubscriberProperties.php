<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitLicenseKeysSubscriberProperties
 */
final class BenefitLicenseKeysSubscriberProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $prefix,
        /**
         * @var BenefitLicenseKeyExpirationProperties|null
         */
        public readonly ?BenefitLicenseKeyExpirationProperties $expires,
        /**
         * @var BenefitLicenseKeyActivationProperties|null
         */
        public readonly ?BenefitLicenseKeyActivationProperties $activations,
        /**
         * @var int|null
         */
        public readonly ?int $limit_usage,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $prefix */
        $prefix = (Json::get($data, 'prefix') === null ? null : Json::toString(Json::get($data, 'prefix')));
        /** @var BenefitLicenseKeyExpirationProperties|null $expires */
        $expires = (Json::get($data, 'expires') === null ? null : BenefitLicenseKeyExpirationProperties::fromArray(Json::toMap(Json::get($data, 'expires'))));
        /** @var BenefitLicenseKeyActivationProperties|null $activations */
        $activations = (Json::get($data, 'activations') === null ? null : BenefitLicenseKeyActivationProperties::fromArray(Json::toMap(Json::get($data, 'activations'))));
        /** @var int|null $limit_usage */
        $limit_usage = (Json::get($data, 'limit_usage') === null ? null : Json::toInt(Json::get($data, 'limit_usage')));

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
        $data['prefix'] = Json::encode($this->prefix);
        $data['expires'] = Json::encode($this->expires);
        $data['activations'] = Json::encode($this->activations);
        $data['limit_usage'] = Json::encode($this->limit_usage);

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