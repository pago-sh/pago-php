<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationCompanyLegalEntitySchema
 */
final class OrganizationCompanyLegalEntitySchema implements Model, Deserializable
{
    public function __construct(
        public readonly string $type,
        public readonly string $registered_name,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        $registered_name = Json::toString(Json::get($data, 'registered_name'));

        return new self(
            type: $type,
            registered_name: $registered_name,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        $data['registered_name'] = Json::encode($this->registered_name);

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