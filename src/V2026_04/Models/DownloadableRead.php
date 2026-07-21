<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * DownloadableRead
 */
final class DownloadableRead implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $benefit_id,
        public readonly FileDownload $file,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $benefit_id = Json::toString(Json::get($data, 'benefit_id'));
        $file = FileDownload::fromArray(Json::toMap(Json::get($data, 'file')));

        return new self(
            id: $id,
            benefit_id: $benefit_id,
            file: $file,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['benefit_id'] = Json::encode($this->benefit_id);
        $data['file'] = Json::encode($this->file);

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