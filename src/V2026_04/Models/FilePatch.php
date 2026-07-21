<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * FilePatch
 */
final class FilePatch implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $version = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $version */
        $version = isset($data['version']) ? Json::toString($data['version']) : null;

        return new self(
            name: $name,
            version: $version,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->version !== null) {
            $data['version'] = Json::encode($this->version);
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