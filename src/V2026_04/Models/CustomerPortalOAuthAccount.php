<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPortalOAuthAccount
 */
final class CustomerPortalOAuthAccount implements Model, Deserializable
{
    public function __construct(
        public readonly string $account_id,
        /**
         * @var string|null
         */
        public readonly ?string $account_username,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $account_id = Json::toString(Json::get($data, 'account_id'));
        /** @var string|null $account_username */
        $account_username = (Json::get($data, 'account_username') === null ? null : Json::toString(Json::get($data, 'account_username')));

        return new self(
            account_id: $account_id,
            account_username: $account_username,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['account_id'] = Json::encode($this->account_id);
        $data['account_username'] = Json::encode($this->account_username);

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