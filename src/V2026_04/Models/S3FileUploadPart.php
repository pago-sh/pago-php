<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3FileUploadPart
 */
final class S3FileUploadPart implements Model, Deserializable
{
    public function __construct(
        public readonly int $number,
        public readonly int $chunk_start,
        public readonly int $chunk_end,
        public readonly string $url,
        public readonly string $expires_at,
        /**
         * @var string|null
         */
        public readonly ?string $checksum_sha256_base64 = null,
        /**
         * @var array<string, string>|null
         */
        public readonly ?array $headers = null,
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
        $url = Json::toString(Json::get($data, 'url'));
        $expires_at = Json::toString(Json::get($data, 'expires_at'));
        /** @var string|null $checksum_sha256_base64 */
        $checksum_sha256_base64 = isset($data['checksum_sha256_base64']) ? Json::toString($data['checksum_sha256_base64']) : null;
        /** @var array<string, string>|null $headers */
        $headers = isset($data['headers']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toMap($data['headers'])) : null;

        return new self(
            number: $number,
            chunk_start: $chunk_start,
            chunk_end: $chunk_end,
            url: $url,
            expires_at: $expires_at,
            checksum_sha256_base64: $checksum_sha256_base64,
            headers: $headers,
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
        $data['url'] = Json::encode($this->url);
        $data['expires_at'] = Json::encode($this->expires_at);
        if ($this->checksum_sha256_base64 !== null) {
            $data['checksum_sha256_base64'] = Json::encode($this->checksum_sha256_base64);
        }
        if ($this->headers !== null) {
            $data['headers'] = Json::encode($this->headers);
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