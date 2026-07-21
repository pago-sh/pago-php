<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * Raised when a verified webhook type is unknown to this SDK version.
 */
final class PagoWebhookUnknownTypeException extends PagoWebhookException
{
    public function __construct(public readonly ?string $eventType)
    {
        parent::__construct(
            sprintf('Unknown webhook event type: %s', $eventType ?? 'null'),
        );
    }
}