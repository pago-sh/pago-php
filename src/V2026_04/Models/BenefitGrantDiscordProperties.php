<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantDiscordProperties
 */
final class BenefitGrantDiscordProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $account_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $guild_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $role_id = null,
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
        /** @var string|null $guild_id */
        $guild_id = isset($data['guild_id']) ? Json::toString($data['guild_id']) : null;
        /** @var string|null $role_id */
        $role_id = isset($data['role_id']) ? Json::toString($data['role_id']) : null;
        /** @var string|null $granted_account_id */
        $granted_account_id = isset($data['granted_account_id']) ? Json::toString($data['granted_account_id']) : null;

        return new self(
            account_id: $account_id,
            guild_id: $guild_id,
            role_id: $role_id,
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
        if ($this->guild_id !== null) {
            $data['guild_id'] = Json::encode($this->guild_id);
        }
        if ($this->role_id !== null) {
            $data['role_id'] = Json::encode($this->role_id);
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