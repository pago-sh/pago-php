<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a file to be used as an organization avatar.
 */
final class OrganizationAvatarFileCreate implements Model, Deserializable, FileCreate
{
    public function __construct(
        public readonly string $name,
        public readonly string $mime_type,
        public readonly int $size,
        public readonly S3FileCreateMultipart $upload,
        public readonly string $service,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_base64 = null,
        /**
         * @var string|null
         */
        public readonly ?string $version = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $mime_type = Json::toString(Json::get($data, 'mime_type'));
        $size = Json::toInt(Json::get($data, 'size'));
        $upload = S3FileCreateMultipart::fromArray(Json::toMap(Json::get($data, 'upload')));
        $service = Json::toString(Json::get($data, 'service'));
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var string|null $checksum_sha256_base64 */
        $checksum_sha256_base64 = isset($data['checksum_sha256_base64']) ? Json::toString($data['checksum_sha256_base64']) : null;
        /** @var string|null $version */
        $version = isset($data['version']) ? Json::toString($data['version']) : null;

        return new self(
            name: $name,
            mime_type: $mime_type,
            size: $size,
            upload: $upload,
            service: $service,
            organization_id: $organization_id,
            checksum_sha256_base64: $checksum_sha256_base64,
            version: $version,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['mime_type'] = Json::encode($this->mime_type);
        $data['size'] = Json::encode($this->size);
        $data['upload'] = Json::encode($this->upload);
        $data['service'] = Json::encode($this->service);
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->checksum_sha256_base64 !== null) {
            $data['checksum_sha256_base64'] = Json::encode($this->checksum_sha256_base64);
        }
        if ($this->version !== null) {
            $data['version'] = Json::encode($this->version);
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