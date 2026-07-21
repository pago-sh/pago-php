<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPortalCustomerSettings
 */
final class CustomerPortalCustomerSettings implements Model, Deserializable
{
    public function __construct(
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_email_change = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var bool|null $allow_email_change */
        $allow_email_change = isset($data['allow_email_change']) ? Json::toBool($data['allow_email_change']) : null;

        return new self(
            allow_email_change: $allow_email_change,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->allow_email_change !== null) {
            $data['allow_email_change'] = Json::encode($this->allow_email_change);
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