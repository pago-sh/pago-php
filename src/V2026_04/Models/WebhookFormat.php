<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * WebhookFormat
 */
enum WebhookFormat: string
{
    case RAW = 'raw';
    case DISCORD = 'discord';
    case SLACK = 'slack';
}