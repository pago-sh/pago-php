<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * File to be associated with the downloadables benefit.
 */
final class DownloadableFileRead implements Model, Deserializable, FileRead
{
    public function __construct(
        public readonly string $id,
        public readonly string $organization_id,
        public readonly string $name,
        public readonly string $path,
        public readonly string $mime_type,
        public readonly int $size,
        /**
         * @var string|null
         */
        public readonly ?string $storage_version,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_etag,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_base64,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_hex,
        /**
         * @var string|null
         */
        public readonly ?string $last_modified_at,
        /**
         * @var string|null
         */
        public readonly ?string $version,
        public readonly string $service,
        public readonly bool $is_uploaded,
        public readonly string $created_at,
        public readonly string $size_readable,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $name = Json::toString(Json::get($data, 'name'));
        $path = Json::toString(Json::get($data, 'path'));
        $mime_type = Json::toString(Json::get($data, 'mime_type'));
        $size = Json::toInt(Json::get($data, 'size'));
        /** @var string|null $storage_version */
        $storage_version = (Json::get($data, 'storage_version') === null ? null : Json::toString(Json::get($data, 'storage_version')));
        /** @var string|null $checksum_etag */
        $checksum_etag = (Json::get($data, 'checksum_etag') === null ? null : Json::toString(Json::get($data, 'checksum_etag')));
        /** @var string|null $checksum_sha256_base64 */
        $checksum_sha256_base64 = (Json::get($data, 'checksum_sha256_base64') === null ? null : Json::toString(Json::get($data, 'checksum_sha256_base64')));
        /** @var string|null $checksum_sha256_hex */
        $checksum_sha256_hex = (Json::get($data, 'checksum_sha256_hex') === null ? null : Json::toString(Json::get($data, 'checksum_sha256_hex')));
        /** @var string|null $last_modified_at */
        $last_modified_at = (Json::get($data, 'last_modified_at') === null ? null : Json::toString(Json::get($data, 'last_modified_at')));
        /** @var string|null $version */
        $version = (Json::get($data, 'version') === null ? null : Json::toString(Json::get($data, 'version')));
        $service = Json::toString(Json::get($data, 'service'));
        $is_uploaded = Json::toBool(Json::get($data, 'is_uploaded'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        $size_readable = Json::toString(Json::get($data, 'size_readable'));

        return new self(
            id: $id,
            organization_id: $organization_id,
            name: $name,
            path: $path,
            mime_type: $mime_type,
            size: $size,
            storage_version: $storage_version,
            checksum_etag: $checksum_etag,
            checksum_sha256_base64: $checksum_sha256_base64,
            checksum_sha256_hex: $checksum_sha256_hex,
            last_modified_at: $last_modified_at,
            version: $version,
            service: $service,
            is_uploaded: $is_uploaded,
            created_at: $created_at,
            size_readable: $size_readable,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['name'] = Json::encode($this->name);
        $data['path'] = Json::encode($this->path);
        $data['mime_type'] = Json::encode($this->mime_type);
        $data['size'] = Json::encode($this->size);
        $data['storage_version'] = Json::encode($this->storage_version);
        $data['checksum_etag'] = Json::encode($this->checksum_etag);
        $data['checksum_sha256_base64'] = Json::encode($this->checksum_sha256_base64);
        $data['checksum_sha256_hex'] = Json::encode($this->checksum_sha256_hex);
        $data['last_modified_at'] = Json::encode($this->last_modified_at);
        $data['version'] = Json::encode($this->version);
        $data['service'] = Json::encode($this->service);
        $data['is_uploaded'] = Json::encode($this->is_uploaded);
        $data['created_at'] = Json::encode($this->created_at);
        $data['size_readable'] = Json::encode($this->size_readable);

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