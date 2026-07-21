<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * TokenType
 */
enum TokenType: string
{
    case ACCESS_TOKEN = 'access_token';
    case REFRESH_TOKEN = 'refresh_token';
}