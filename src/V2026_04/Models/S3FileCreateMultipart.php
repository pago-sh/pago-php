<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * S3FileCreateMultipart
 */
final class S3FileCreateMultipart implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<S3FileCreatePart>
         */
        public readonly array $parts,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<S3FileCreatePart> $parts */
        $parts = array_map(static fn (mixed $item0): S3FileCreatePart => S3FileCreatePart::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'parts')));

        return new self(
            parts: $parts,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
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