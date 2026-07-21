<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * TokenEndpointAuthMethod
 */
enum TokenEndpointAuthMethod: string
{
    case CLIENT_SECRET_BASIC = 'client_secret_basic';
    case CLIENT_SECRET_POST = 'client_secret_post';
    case NONE = 'none';
}