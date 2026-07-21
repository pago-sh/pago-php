<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LicenseKeyActivationRead
 */
final class LicenseKeyActivationRead implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $license_key_id,
        public readonly string $label,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $meta,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly LicenseKeyRead $license_key,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $license_key_id = Json::toString(Json::get($data, 'license_key_id'));
        $label = Json::toString(Json::get($data, 'label'));
        /** @var array<string, string|int|float|bool> $meta */
        $meta = Json::toMap(Json::get($data, 'meta'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $license_key = LicenseKeyRead::fromArray(Json::toMap(Json::get($data, 'license_key')));

        return new self(
            id: $id,
            license_key_id: $license_key_id,
            label: $label,
            meta: $meta,
            created_at: $created_at,
            modified_at: $modified_at,
            license_key: $license_key,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['license_key_id'] = Json::encode($this->license_key_id);
        $data['label'] = Json::encode($this->label);
        $data['meta'] = Json::encode($this->meta);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['license_key'] = Json::encode($this->license_key);

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