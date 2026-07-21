<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\RefundedAlready as RefundedAlreadyModel;
use Throwable;

/**
 * Order is already fully refunded.
 *
 * Raised when the API responds with HTTP 403.
 */
final class RefundedAlready extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?RefundedAlreadyModel $error;

    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Order is already fully refunded.');

        $decoded = null;

        try {
            $decoded = RefundedAlreadyModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}