<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomFieldSelectProperties
 */
final class CustomFieldSelectProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<CustomFieldSelectOption>
         */
        public readonly array $options,
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
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<CustomFieldSelectOption> $options */
        $options = array_map(static fn (mixed $item0): CustomFieldSelectOption => CustomFieldSelectOption::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'options')));
        /** @var string|null $form_label */
        $form_label = isset($data['form_label']) ? Json::toString($data['form_label']) : null;
        /** @var string|null $form_help_text */
        $form_help_text = isset($data['form_help_text']) ? Json::toString($data['form_help_text']) : null;
        /** @var string|null $form_placeholder */
        $form_placeholder = isset($data['form_placeholder']) ? Json::toString($data['form_placeholder']) : null;

        return new self(
            options: $options,
            form_label: $form_label,
            form_help_text: $form_help_text,
            form_placeholder: $form_placeholder,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['options'] = Json::encode($this->options);
        if ($this->form_label !== null) {
            $data['form_label'] = Json::encode($this->form_label);
        }
        if ($this->form_help_text !== null) {
            $data['form_help_text'] = Json::encode($this->form_help_text);
        }
        if ($this->form_placeholder !== null) {
            $data['form_placeholder'] = Json::encode($this->form_placeholder);
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