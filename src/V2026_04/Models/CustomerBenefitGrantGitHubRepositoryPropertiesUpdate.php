<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerBenefitGrantGitHubRepositoryPropertiesUpdate
 */
final class CustomerBenefitGrantGitHubRepositoryPropertiesUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $account_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $account_id */
        $account_id = (Json::get($data, 'account_id') === null ? null : Json::toString(Json::get($data, 'account_id')));

        return new self(
            account_id: $account_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['account_id'] = Json::encode($this->account_id);

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