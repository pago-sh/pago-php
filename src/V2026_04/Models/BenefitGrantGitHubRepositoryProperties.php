<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantGitHubRepositoryProperties
 */
final class BenefitGrantGitHubRepositoryProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $account_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $repository_owner = null,
        /**
         * @var string|null
         */
        public readonly ?string $repository_name = null,
        /**
         * @var Permission|null
         */
        public readonly ?Permission $permission = null,
        /**
         * @var string|null
         */
        public readonly ?string $granted_account_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $account_id */
        $account_id = isset($data['account_id']) ? Json::toString($data['account_id']) : null;
        /** @var string|null $repository_owner */
        $repository_owner = isset($data['repository_owner']) ? Json::toString($data['repository_owner']) : null;
        /** @var string|null $repository_name */
        $repository_name = isset($data['repository_name']) ? Json::toString($data['repository_name']) : null;
        /** @var Permission|null $permission */
        $permission = isset($data['permission']) ? Permission::from(Json::toString($data['permission'])) : null;
        /** @var string|null $granted_account_id */
        $granted_account_id = isset($data['granted_account_id']) ? Json::toString($data['granted_account_id']) : null;

        return new self(
            account_id: $account_id,
            repository_owner: $repository_owner,
            repository_name: $repository_name,
            permission: $permission,
            granted_account_id: $granted_account_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->account_id !== null) {
            $data['account_id'] = Json::encode($this->account_id);
        }
        if ($this->repository_owner !== null) {
            $data['repository_owner'] = Json::encode($this->repository_owner);
        }
        if ($this->repository_name !== null) {
            $data['repository_name'] = Json::encode($this->repository_name);
        }
        if ($this->permission !== null) {
            $data['permission'] = Json::encode($this->permission);
        }
        if ($this->granted_account_id !== null) {
            $data['granted_account_id'] = Json::encode($this->granted_account_id);
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