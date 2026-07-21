<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * UserInfoOrganization
 */
final class UserInfoOrganization implements Model, Deserializable
{
    public function __construct(
        public readonly string $sub,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $sub = Json::toString(Json::get($data, 'sub'));
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;

        return new self(
            sub: $sub,
            name: $name,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['sub'] = Json::encode($this->sub);
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
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