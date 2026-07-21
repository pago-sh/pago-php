<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventMetadataInput
 */
final class EventMetadataInput implements Model, Deserializable
{
    public function __construct(
        /**
         * @var CostMetadataInput|null
         */
        public readonly ?CostMetadataInput $_cost = null,
        /**
         * @var LLMMetadata|null
         */
        public readonly ?LLMMetadata $_llm = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var CostMetadataInput|null $_cost */
        $_cost = isset($data['_cost']) ? CostMetadataInput::fromArray(Json::toMap($data['_cost'])) : null;
        /** @var LLMMetadata|null $_llm */
        $_llm = isset($data['_llm']) ? LLMMetadata::fromArray(Json::toMap($data['_llm'])) : null;

        return new self(
            _cost: $_cost,
            _llm: $_llm,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->_cost !== null) {
            $data['_cost'] = Json::encode($this->_cost);
        }
        if ($this->_llm !== null) {
            $data['_llm'] = Json::encode($this->_llm);
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