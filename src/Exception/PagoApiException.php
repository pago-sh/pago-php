<?php

declare(strict_types=1);

namespace Pago\Exception;

use Pago\Serialization\Json;

/**
 * The Pago API responded with a 4xx status code.
 *
 * Every generated, endpoint-specific error extends this class and exposes the
 * decoded error body through a typed property.
 */
class PagoApiException extends PagoException
{
    public function __construct(
        public readonly int $statusCode,
        public readonly mixed $body = null,
        ?string $message = null,
    ) {
        parent::__construct(
            $message ?? sprintf(
                'Pago API returned an error: %d - %s',
                $statusCode,
                is_string($body) ? $body : Json::stringify($body),
            ),
        );
    }
}