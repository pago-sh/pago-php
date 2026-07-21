<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitSlackSharedChannelCreateProperties
 */
final class BenefitSlackSharedChannelCreateProperties implements Model, Deserializable
{
    public function __construct(
        public readonly string $slack_integration_id,
        public readonly string $channel_name_template,
        /**
         * @var bool|null
         */
        public readonly ?bool $private = null,
        /**
         * @var string|null
         */
        public readonly ?string $welcome_message = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $archive_on_revoke = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $team_invitees = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $slack_integration_id = Json::toString(Json::get($data, 'slack_integration_id'));
        $channel_name_template = Json::toString(Json::get($data, 'channel_name_template'));
        /** @var bool|null $private */
        $private = isset($data['private']) ? Json::toBool($data['private']) : null;
        /** @var string|null $welcome_message */
        $welcome_message = isset($data['welcome_message']) ? Json::toString($data['welcome_message']) : null;
        /** @var bool|null $archive_on_revoke */
        $archive_on_revoke = isset($data['archive_on_revoke']) ? Json::toBool($data['archive_on_revoke']) : null;
        /** @var list<string>|null $team_invitees */
        $team_invitees = isset($data['team_invitees']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['team_invitees'])) : null;

        return new self(
            slack_integration_id: $slack_integration_id,
            channel_name_template: $channel_name_template,
            private: $private,
            welcome_message: $welcome_message,
            archive_on_revoke: $archive_on_revoke,
            team_invitees: $team_invitees,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['slack_integration_id'] = Json::encode($this->slack_integration_id);
        $data['channel_name_template'] = Json::encode($this->channel_name_template);
        if ($this->private !== null) {
            $data['private'] = Json::encode($this->private);
        }
        if ($this->welcome_message !== null) {
            $data['welcome_message'] = Json::encode($this->welcome_message);
        }
        if ($this->archive_on_revoke !== null) {
            $data['archive_on_revoke'] = Json::encode($this->archive_on_revoke);
        }
        if ($this->team_invitees !== null) {
            $data['team_invitees'] = Json::encode($this->team_invitees);
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