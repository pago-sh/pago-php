<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitDownloadablesProperties
 */
final class BenefitDownloadablesProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, bool>
         */
        public readonly array $archived,
        /**
         * @var list<string>
         */
        public readonly array $files,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, bool> $archived */
        $archived = array_map(static fn (mixed $item0): bool => Json::toBool($item0), Json::toMap(Json::get($data, 'archived')));
        /** @var list<string> $files */
        $files = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'files')));

        return new self(
            archived: $archived,
            files: $files,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['archived'] = Json::encode($this->archived);
        $data['files'] = Json::encode($this->files);

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