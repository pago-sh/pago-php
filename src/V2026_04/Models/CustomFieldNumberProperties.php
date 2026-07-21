<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomFieldNumberProperties
 */
final class CustomFieldNumberProperties implements Model, Deserializable
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
         * @var int|null
         */
        public readonly ?int $ge = null,
        /**
         * @var int|null
         */
        public readonly ?int $le = null,
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
        /** @var int|null $ge */
        $ge = isset($data['ge']) ? Json::toInt($data['ge']) : null;
        /** @var int|null $le */
        $le = isset($data['le']) ? Json::toInt($data['le']) : null;

        return new self(
            form_label: $form_label,
            form_help_text: $form_help_text,
            form_placeholder: $form_placeholder,
            ge: $ge,
            le: $le,
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
        if ($this->ge !== null) {
            $data['ge'] = Json::encode($this->ge);
        }
        if ($this->le !== null) {
            $data['le'] = Json::encode($this->le);
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