<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LLMMetadata
 */
final class LLMMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $vendor,
        public readonly string $model,
        public readonly int $input_tokens,
        public readonly int $output_tokens,
        public readonly int $total_tokens,
        /**
         * @var string|null
         */
        public readonly ?string $prompt = null,
        /**
         * @var string|null
         */
        public readonly ?string $response = null,
        /**
         * @var int|null
         */
        public readonly ?int $cached_input_tokens = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $vendor = Json::toString(Json::get($data, 'vendor'));
        $model = Json::toString(Json::get($data, 'model'));
        $input_tokens = Json::toInt(Json::get($data, 'input_tokens'));
        $output_tokens = Json::toInt(Json::get($data, 'output_tokens'));
        $total_tokens = Json::toInt(Json::get($data, 'total_tokens'));
        /** @var string|null $prompt */
        $prompt = isset($data['prompt']) ? Json::toString($data['prompt']) : null;
        /** @var string|null $response */
        $response = isset($data['response']) ? Json::toString($data['response']) : null;
        /** @var int|null $cached_input_tokens */
        $cached_input_tokens = isset($data['cached_input_tokens']) ? Json::toInt($data['cached_input_tokens']) : null;

        return new self(
            vendor: $vendor,
            model: $model,
            input_tokens: $input_tokens,
            output_tokens: $output_tokens,
            total_tokens: $total_tokens,
            prompt: $prompt,
            response: $response,
            cached_input_tokens: $cached_input_tokens,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['vendor'] = Json::encode($this->vendor);
        $data['model'] = Json::encode($this->model);
        $data['input_tokens'] = Json::encode($this->input_tokens);
        $data['output_tokens'] = Json::encode($this->output_tokens);
        $data['total_tokens'] = Json::encode($this->total_tokens);
        if ($this->prompt !== null) {
            $data['prompt'] = Json::encode($this->prompt);
        }
        if ($this->response !== null) {
            $data['response'] = Json::encode($this->response);
        }
        if ($this->cached_input_tokens !== null) {
            $data['cached_input_tokens'] = Json::encode($this->cached_input_tokens);
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