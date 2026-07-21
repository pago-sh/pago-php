<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitLicenseKeyExpirationProperties
 */
final class BenefitLicenseKeyExpirationProperties implements Model, Deserializable
{
    public function __construct(
        public readonly int $ttl,
        public readonly Timeframe $timeframe,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $ttl = Json::toInt(Json::get($data, 'ttl'));
        $timeframe = Timeframe::from(Json::toString(Json::get($data, 'timeframe')));

        return new self(
            ttl: $ttl,
            timeframe: $timeframe,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['ttl'] = Json::encode($this->ttl);
        $data['timeframe'] = Json::encode($this->timeframe);

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