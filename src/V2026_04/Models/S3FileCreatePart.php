<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3FileCreatePart
 */
final class S3FileCreatePart implements Model, Deserializable
{
    public function __construct(
        public readonly int $number,
        public readonly int $chunk_start,
        public readonly int $chunk_end,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_base64 = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $number = Json::toInt(Json::get($data, 'number'));
        $chunk_start = Json::toInt(Json::get($data, 'chunk_start'));
        $chunk_end = Json::toInt(Json::get($data, 'chunk_end'));
        /** @var string|null $checksum_sha256_base64 */
        $checksum_sha256_base64 = isset($data['checksum_sha256_base64']) ? Json::toString($data['checksum_sha256_base64']) : null;

        return new self(
            number: $number,
            chunk_start: $chunk_start,
            chunk_end: $chunk_end,
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
        $data['chunk_start'] = Json::encode($this->chunk_start);
        $data['chunk_end'] = Json::encode($this->chunk_end);
        if ($this->checksum_sha256_base64 !== null) {
            $data['checksum_sha256_base64'] = Json::encode($this->checksum_sha256_base64);
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