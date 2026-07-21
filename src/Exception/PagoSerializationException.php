<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * A payload could not be decoded into the shape the API schema promises.
 */
final class PagoSerializationException extends PagoException
{
}