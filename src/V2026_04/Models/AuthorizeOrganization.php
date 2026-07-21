<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * AuthorizeOrganization
 */
final class AuthorizeOrganization implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $slug,
        /**
         * @var string|null
         */
        public readonly ?string $avatar_url,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $slug = Json::toString(Json::get($data, 'slug'));
        /** @var string|null $avatar_url */
        $avatar_url = (Json::get($data, 'avatar_url') === null ? null : Json::toString(Json::get($data, 'avatar_url')));

        return new self(
            id: $id,
            slug: $slug,
            avatar_url: $avatar_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['slug'] = Json::encode($this->slug);
        $data['avatar_url'] = Json::encode($this->avatar_url);

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