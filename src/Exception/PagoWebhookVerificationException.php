<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * Raised when a Pago webhook signature cannot be verified.
 */
final class PagoWebhookVerificationException extends PagoWebhookException
{
}