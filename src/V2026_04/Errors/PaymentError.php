<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\PaymentError as PaymentErrorModel;
use Throwable;

/**
 * The payment failed.
 *
 * Raised when the API responds with HTTP 400.
 */
final class PaymentError extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?PaymentErrorModel $error;

    public function __construct(int $statusCode = 400, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The payment failed.');

        $decoded = null;

        try {
            $decoded = PaymentErrorModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}