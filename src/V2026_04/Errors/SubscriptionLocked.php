<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\SubscriptionLocked as SubscriptionLockedModel;
use Throwable;

/**
 * Subscription is pending an update.
 *
 * Raised when the API responds with HTTP 409.
 */
final class SubscriptionLocked extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?SubscriptionLockedModel $error;

    public function __construct(int $statusCode = 409, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Subscription is pending an update.');

        $decoded = null;

        try {
            $decoded = SubscriptionLockedModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}