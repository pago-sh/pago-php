<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * ValidationError
 */
final class ValidationError implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string|int>
         */
        public readonly array $loc,
        public readonly string $msg,
        public readonly string $type,
        public readonly mixed $input = null,
        /**
         * @var Context|null
         */
        public readonly ?Context $ctx = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string|int> $loc */
        $loc = Json::toList(Json::get($data, 'loc'));
        $msg = Json::toString(Json::get($data, 'msg'));
        $type = Json::toString(Json::get($data, 'type'));
        $input = isset($data['input']) ? $data['input'] : null;
        /** @var Context|null $ctx */
        $ctx = isset($data['ctx']) ? Context::fromArray(Json::toMap($data['ctx'])) : null;

        return new self(
            loc: $loc,
            msg: $msg,
            type: $type,
            input: $input,
            ctx: $ctx,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['loc'] = Json::encode($this->loc);
        $data['msg'] = Json::encode($this->msg);
        $data['type'] = Json::encode($this->type);
        if ($this->input !== null) {
            $data['input'] = Json::encode($this->input);
        }
        if ($this->ctx !== null) {
            $data['ctx'] = Json::encode($this->ctx);
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