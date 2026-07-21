<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3FileUploadMultipart
 */
final class S3FileUploadMultipart implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $path,
        /**
         * @var list<S3FileUploadPart>
         */
        public readonly array $parts,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $path = Json::toString(Json::get($data, 'path'));
        /** @var list<S3FileUploadPart> $parts */
        $parts = array_map(static fn (mixed $item0): S3FileUploadPart => S3FileUploadPart::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'parts')));

        return new self(
            id: $id,
            path: $path,
            parts: $parts,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['path'] = Json::encode($this->path);
        $data['parts'] = Json::encode($this->parts);

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