<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitDownloadablesSubscriberProperties
 */
final class BenefitDownloadablesSubscriberProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>
         */
        public readonly array $active_files,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string> $active_files */
        $active_files = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'active_files')));

        return new self(
            active_files: $active_files,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['active_files'] = Json::encode($this->active_files);

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