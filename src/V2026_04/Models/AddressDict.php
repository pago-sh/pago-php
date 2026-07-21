<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * AddressDict
 */
final class AddressDict implements Model, Deserializable
{
    public function __construct(
        public readonly string $country,
        /**
         * @var string|null
         */
        public readonly ?string $line1 = null,
        /**
         * @var string|null
         */
        public readonly ?string $line2 = null,
        /**
         * @var string|null
         */
        public readonly ?string $postal_code = null,
        /**
         * @var string|null
         */
        public readonly ?string $city = null,
        /**
         * @var string|null
         */
        public readonly ?string $state = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $country = Json::toString(Json::get($data, 'country'));
        /** @var string|null $line1 */
        $line1 = isset($data['line1']) ? Json::toString($data['line1']) : null;
        /** @var string|null $line2 */
        $line2 = isset($data['line2']) ? Json::toString($data['line2']) : null;
        /** @var string|null $postal_code */
        $postal_code = isset($data['postal_code']) ? Json::toString($data['postal_code']) : null;
        /** @var string|null $city */
        $city = isset($data['city']) ? Json::toString($data['city']) : null;
        /** @var string|null $state */
        $state = isset($data['state']) ? Json::toString($data['state']) : null;

        return new self(
            country: $country,
            line1: $line1,
            line2: $line2,
            postal_code: $postal_code,
            city: $city,
            state: $state,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['country'] = Json::encode($this->country);
        if ($this->line1 !== null) {
            $data['line1'] = Json::encode($this->line1);
        }
        if ($this->line2 !== null) {
            $data['line2'] = Json::encode($this->line2);
        }
        if ($this->postal_code !== null) {
            $data['postal_code'] = Json::encode($this->postal_code);
        }
        if ($this->city !== null) {
            $data['city'] = Json::encode($this->city);
        }
        if ($this->state !== null) {
            $data['state'] = Json::encode($this->state);
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