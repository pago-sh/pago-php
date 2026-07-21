<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\ManualRetryLimitExceeded as ManualRetryLimitExceededModel;
use Throwable;

/**
 * Manual retry limit exceeded.
 *
 * Raised when the API responds with HTTP 429.
 */
final class ManualRetryLimitExceeded extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?ManualRetryLimitExceededModel $error;

    public function __construct(int $statusCode = 429, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Manual retry limit exceeded.');

        $decoded = null;

        try {
            $decoded = ManualRetryLimitExceededModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}