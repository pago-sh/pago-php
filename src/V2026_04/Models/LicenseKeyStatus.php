<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * LicenseKeyStatus
 */
enum LicenseKeyStatus: string
{
    case GRANTED = 'granted';
    case REVOKED = 'revoked';
    case DISABLED = 'disabled';
}