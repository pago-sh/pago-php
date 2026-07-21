<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\OrderNotDraft as OrderNotDraftModel;
use Throwable;

/**
 * The order is not in `draft` status.
 *
 * Raised when the API responds with HTTP 412.
 */
final class OrderNotDraft extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?OrderNotDraftModel $error;

    public function __construct(int $statusCode = 412, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The order is not in `draft` status.');

        $decoded = null;

        try {
            $decoded = OrderNotDraftModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}