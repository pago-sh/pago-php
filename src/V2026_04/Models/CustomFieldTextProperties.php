<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomFieldTextProperties
 */
final class CustomFieldTextProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $form_label = null,
        /**
         * @var string|null
         */
        public readonly ?string $form_help_text = null,
        /**
         * @var string|null
         */
        public readonly ?string $form_placeholder = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $textarea = null,
        /**
         * @var int|null
         */
        public readonly ?int $min_length = null,
        /**
         * @var int|null
         */
        public readonly ?int $max_length = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $form_label */
        $form_label = isset($data['form_label']) ? Json::toString($data['form_label']) : null;
        /** @var string|null $form_help_text */
        $form_help_text = isset($data['form_help_text']) ? Json::toString($data['form_help_text']) : null;
        /** @var string|null $form_placeholder */
        $form_placeholder = isset($data['form_placeholder']) ? Json::toString($data['form_placeholder']) : null;
        /** @var bool|null $textarea */
        $textarea = isset($data['textarea']) ? Json::toBool($data['textarea']) : null;
        /** @var int|null $min_length */
        $min_length = isset($data['min_length']) ? Json::toInt($data['min_length']) : null;
        /** @var int|null $max_length */
        $max_length = isset($data['max_length']) ? Json::toInt($data['max_length']) : null;

        return new self(
            form_label: $form_label,
            form_help_text: $form_help_text,
            form_placeholder: $form_placeholder,
            textarea: $textarea,
            min_length: $min_length,
            max_length: $max_length,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->form_label !== null) {
            $data['form_label'] = Json::encode($this->form_label);
        }
        if ($this->form_help_text !== null) {
            $data['form_help_text'] = Json::encode($this->form_help_text);
        }
        if ($this->form_placeholder !== null) {
            $data['form_placeholder'] = Json::encode($this->form_placeholder);
        }
        if ($this->textarea !== null) {
            $data['textarea'] = Json::encode($this->textarea);
        }
        if ($this->min_length !== null) {
            $data['min_length'] = Json::encode($this->min_length);
        }
        if ($this->max_length !== null) {
            $data['max_length'] = Json::encode($this->max_length);
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