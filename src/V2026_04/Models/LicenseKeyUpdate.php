<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LicenseKeyUpdate
 */
final class LicenseKeyUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var LicenseKeyStatus|null
         */
        public readonly ?LicenseKeyStatus $status = null,
        /**
         * @var int|null
         */
        public readonly ?int $usage = null,
        /**
         * @var int|null
         */
        public readonly ?int $limit_activations = null,
        /**
         * @var int|null
         */
        public readonly ?int $limit_usage = null,
        /**
         * @var string|null
         */
        public readonly ?string $expires_at = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var LicenseKeyStatus|null $status */
        $status = isset($data['status']) ? LicenseKeyStatus::from(Json::toString($data['status'])) : null;
        /** @var int|null $usage */
        $usage = isset($data['usage']) ? Json::toInt($data['usage']) : null;
        /** @var int|null $limit_activations */
        $limit_activations = isset($data['limit_activations']) ? Json::toInt($data['limit_activations']) : null;
        /** @var int|null $limit_usage */
        $limit_usage = isset($data['limit_usage']) ? Json::toInt($data['limit_usage']) : null;
        /** @var string|null $expires_at */
        $expires_at = isset($data['expires_at']) ? Json::toString($data['expires_at']) : null;

        return new self(
            status: $status,
            usage: $usage,
            limit_activations: $limit_activations,
            limit_usage: $limit_usage,
            expires_at: $expires_at,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->status !== null) {
            $data['status'] = Json::encode($this->status);
        }
        if ($this->usage !== null) {
            $data['usage'] = Json::encode($this->usage);
        }
        if ($this->limit_activations !== null) {
            $data['limit_activations'] = Json::encode($this->limit_activations);
        }
        if ($this->limit_usage !== null) {
            $data['limit_usage'] = Json::encode($this->limit_usage);
        }
        if ($this->expires_at !== null) {
            $data['expires_at'] = Json::encode($this->expires_at);
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