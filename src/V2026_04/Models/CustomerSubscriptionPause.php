<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSubscriptionPause
 */
final class CustomerSubscriptionPause implements Model, Deserializable, CustomerSubscriptionUpdate
{
    public function __construct(
        public readonly bool $pause_at_period_end,
        /**
         * @var string|null
         */
        public readonly ?string $resumes_at = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $pause_at_period_end = Json::toBool(Json::get($data, 'pause_at_period_end'));
        /** @var string|null $resumes_at */
        $resumes_at = isset($data['resumes_at']) ? Json::toString($data['resumes_at']) : null;

        return new self(
            pause_at_period_end: $pause_at_period_end,
            resumes_at: $resumes_at,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['pause_at_period_end'] = Json::encode($this->pause_at_period_end);
        if ($this->resumes_at !== null) {
            $data['resumes_at'] = Json::encode($this->resumes_at);
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