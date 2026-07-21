<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3FileUploadCompletedPart
 */
final class S3FileUploadCompletedPart implements Model, Deserializable
{
    public function __construct(
        public readonly int $number,
        public readonly string $checksum_etag,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_base64,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $number = Json::toInt(Json::get($data, 'number'));
        $checksum_etag = Json::toString(Json::get($data, 'checksum_etag'));
        /** @var string|null $checksum_sha256_base64 */
        $checksum_sha256_base64 = (Json::get($data, 'checksum_sha256_base64') === null ? null : Json::toString(Json::get($data, 'checksum_sha256_base64')));

        return new self(
            number: $number,
            checksum_etag: $checksum_etag,
            checksum_sha256_base64: $checksum_sha256_base64,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['number'] = Json::encode($this->number);
        $data['checksum_etag'] = Json::encode($this->checksum_etag);
        $data['checksum_sha256_base64'] = Json::encode($this->checksum_sha256_base64);

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