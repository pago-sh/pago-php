<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Properties available to subscribers for a benefit of type `github_repository`.
 */
final class BenefitGitHubRepositorySubscriberProperties implements Model, Deserializable
{
    public function __construct(
        public readonly string $repository_owner,
        public readonly string $repository_name,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $repository_owner = Json::toString(Json::get($data, 'repository_owner'));
        $repository_name = Json::toString(Json::get($data, 'repository_name'));

        return new self(
            repository_owner: $repository_owner,
            repository_name: $repository_name,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['repository_owner'] = Json::encode($this->repository_owner);
        $data['repository_name'] = Json::encode($this->repository_name);

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