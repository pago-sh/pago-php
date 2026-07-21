<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitDownloadablesCreateProperties
 */
final class BenefitDownloadablesCreateProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>
         */
        public readonly array $files,
        /**
         * @var array<string, bool>|null
         */
        public readonly ?array $archived = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string> $files */
        $files = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'files')));
        /** @var array<string, bool>|null $archived */
        $archived = isset($data['archived']) ? array_map(static fn (mixed $item0): bool => Json::toBool($item0), Json::toMap($data['archived'])) : null;

        return new self(
            files: $files,
            archived: $archived,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['files'] = Json::encode($this->files);
        if ($this->archived !== null) {
            $data['archived'] = Json::encode($this->archived);
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