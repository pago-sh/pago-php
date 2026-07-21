<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantDownloadablesProperties
 */
final class BenefitGrantDownloadablesProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>|null
         */
        public readonly ?array $files = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string>|null $files */
        $files = isset($data['files']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['files'])) : null;

        return new self(
            files: $files,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->files !== null) {
            $data['files'] = Json::encode($this->files);
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