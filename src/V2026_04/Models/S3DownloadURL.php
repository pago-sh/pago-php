<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3DownloadURL
 */
final class S3DownloadURL implements Model, Deserializable
{
    public function __construct(
        public readonly string $url,
        public readonly string $expires_at,
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
        $url = Json::toString(Json::get($data, 'url'));
        $expires_at = Json::toString(Json::get($data, 'expires_at'));
        /** @var array<string, string>|null $headers */
        $headers = isset($data['headers']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toMap($data['headers'])) : null;

        return new self(
            url: $url,
            expires_at: $expires_at,
            headers: $headers,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['url'] = Json::encode($this->url);
        $data['expires_at'] = Json::encode($this->expires_at);
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