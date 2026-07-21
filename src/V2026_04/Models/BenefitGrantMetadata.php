<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantMetadata
 */
final class BenefitGrantMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $benefit_id,
        public readonly string $benefit_grant_id,
        public readonly BenefitType $benefit_type,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $benefit_id = Json::toString(Json::get($data, 'benefit_id'));
        $benefit_grant_id = Json::toString(Json::get($data, 'benefit_grant_id'));
        $benefit_type = BenefitType::from(Json::toString(Json::get($data, 'benefit_type')));
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;

        return new self(
            benefit_id: $benefit_id,
            benefit_grant_id: $benefit_grant_id,
            benefit_type: $benefit_type,
            member_id: $member_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['benefit_id'] = Json::encode($this->benefit_id);
        $data['benefit_grant_id'] = Json::encode($this->benefit_grant_id);
        $data['benefit_type'] = Json::encode($this->benefit_type);
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
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