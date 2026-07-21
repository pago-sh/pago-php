<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantLicenseKeysProperties
 */
final class BenefitGrantLicenseKeysProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $user_provided_key = null,
        /**
         * @var string|null
         */
        public readonly ?string $license_key_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $display_key = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $user_provided_key */
        $user_provided_key = isset($data['user_provided_key']) ? Json::toString($data['user_provided_key']) : null;
        /** @var string|null $license_key_id */
        $license_key_id = isset($data['license_key_id']) ? Json::toString($data['license_key_id']) : null;
        /** @var string|null $display_key */
        $display_key = isset($data['display_key']) ? Json::toString($data['display_key']) : null;

        return new self(
            user_provided_key: $user_provided_key,
            license_key_id: $license_key_id,
            display_key: $display_key,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->user_provided_key !== null) {
            $data['user_provided_key'] = Json::encode($this->user_provided_key);
        }
        if ($this->license_key_id !== null) {
            $data['license_key_id'] = Json::encode($this->license_key_id);
        }
        if ($this->display_key !== null) {
            $data['display_key'] = Json::encode($this->display_key);
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