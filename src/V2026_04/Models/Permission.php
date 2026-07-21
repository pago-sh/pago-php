<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * The permission level to grant. Read more about roles and their permissions on [GitHub documentation](https://docs.github.com/en/organizations/managing-user-access-to-your-organizations-repositories/managing-repository-roles/repository-roles-for-an-organization#permissions-for-each-role).
 */
enum Permission: string
{
    case PULL = 'pull';
    case TRIAGE = 'triage';
    case PUSH = 'push';
    case MAINTAIN = 'maintain';
    case ADMIN = 'admin';
}