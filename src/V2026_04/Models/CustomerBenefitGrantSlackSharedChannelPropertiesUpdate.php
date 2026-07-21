<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerBenefitGrantSlackSharedChannelPropertiesUpdate
 */
final class CustomerBenefitGrantSlackSharedChannelPropertiesUpdate implements Model, Deserializable
{
    public function __construct(
        public readonly string $invited_email,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $invited_email = Json::toString(Json::get($data, 'invited_email'));

        return new self(
            invited_email: $invited_email,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['invited_email'] = Json::encode($this->invited_email);

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