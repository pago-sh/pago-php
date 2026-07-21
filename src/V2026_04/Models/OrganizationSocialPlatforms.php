<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrganizationSocialPlatforms
 */
enum OrganizationSocialPlatforms: string
{
    case X = 'x';
    case GITHUB = 'github';
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case YOUTUBE = 'youtube';
    case TIKTOK = 'tiktok';
    case LINKEDIN = 'linkedin';
    case THREADS = 'threads';
    case DISCORD = 'discord';
    case OTHER = 'other';
}