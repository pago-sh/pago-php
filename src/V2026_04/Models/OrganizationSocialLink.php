<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationSocialLink
 */
final class OrganizationSocialLink implements Model, Deserializable
{
    public function __construct(
        public readonly OrganizationSocialPlatforms $platform,
        public readonly string $url,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $platform = OrganizationSocialPlatforms::from(Json::toString(Json::get($data, 'platform')));
        $url = Json::toString(Json::get($data, 'url'));

        return new self(
            platform: $platform,
            url: $url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['platform'] = Json::encode($this->platform);
        $data['url'] = Json::encode($this->url);

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