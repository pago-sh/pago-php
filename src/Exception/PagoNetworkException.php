<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * The request never reached the Pago API (DNS, TLS, timeout, ...).
 */
final class PagoNetworkException extends PagoException
{
}