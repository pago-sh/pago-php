<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\AlreadyCanceledSubscription as AlreadyCanceledSubscriptionModel;
use Throwable;

/**
 * This subscription is already revoked.
 *
 * Raised when the API responds with HTTP 403.
 */
final class AlreadyCanceledSubscription extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?AlreadyCanceledSubscriptionModel $error;

    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'This subscription is already revoked.');

        $decoded = null;

        try {
            $decoded = AlreadyCanceledSubscriptionModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}