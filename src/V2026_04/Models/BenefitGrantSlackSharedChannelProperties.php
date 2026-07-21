<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantSlackSharedChannelProperties
 */
final class BenefitGrantSlackSharedChannelProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $invited_email = null,
        /**
         * @var string|null
         */
        public readonly ?string $channel_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $channel_name = null,
        /**
         * @var string|null
         */
        public readonly ?string $invite_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $invite_url = null,
        /**
         * @var string|null
         */
        public readonly ?string $connected_team_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $invited_email */
        $invited_email = isset($data['invited_email']) ? Json::toString($data['invited_email']) : null;
        /** @var string|null $channel_id */
        $channel_id = isset($data['channel_id']) ? Json::toString($data['channel_id']) : null;
        /** @var string|null $channel_name */
        $channel_name = isset($data['channel_name']) ? Json::toString($data['channel_name']) : null;
        /** @var string|null $invite_id */
        $invite_id = isset($data['invite_id']) ? Json::toString($data['invite_id']) : null;
        /** @var string|null $invite_url */
        $invite_url = isset($data['invite_url']) ? Json::toString($data['invite_url']) : null;
        /** @var string|null $connected_team_id */
        $connected_team_id = isset($data['connected_team_id']) ? Json::toString($data['connected_team_id']) : null;

        return new self(
            invited_email: $invited_email,
            channel_id: $channel_id,
            channel_name: $channel_name,
            invite_id: $invite_id,
            invite_url: $invite_url,
            connected_team_id: $connected_team_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->invited_email !== null) {
            $data['invited_email'] = Json::encode($this->invited_email);
        }
        if ($this->channel_id !== null) {
            $data['channel_id'] = Json::encode($this->channel_id);
        }
        if ($this->channel_name !== null) {
            $data['channel_name'] = Json::encode($this->channel_name);
        }
        if ($this->invite_id !== null) {
            $data['invite_id'] = Json::encode($this->invite_id);
        }
        if ($this->invite_url !== null) {
            $data['invite_url'] = Json::encode($this->invite_url);
        }
        if ($this->connected_team_id !== null) {
            $data['connected_team_id'] = Json::encode($this->connected_team_id);
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