<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * Scope
 */
enum Scope: string
{
    case OPENID = 'openid';
    case PROFILE = 'profile';
    case EMAIL = 'email';
    case USER_READ = 'user:read';
    case USER_WRITE = 'user:write';
    case ORGANIZATIONS_READ = 'organizations:read';
    case ORGANIZATIONS_WRITE = 'organizations:write';
    case CUSTOM_FIELDS_READ = 'custom_fields:read';
    case CUSTOM_FIELDS_WRITE = 'custom_fields:write';
    case DISCOUNTS_READ = 'discounts:read';
    case DISCOUNTS_WRITE = 'discounts:write';
    case CHECKOUT_LINKS_READ = 'checkout_links:read';
    case CHECKOUT_LINKS_WRITE = 'checkout_links:write';
    case CHECKOUTS_READ = 'checkouts:read';
    case CHECKOUTS_WRITE = 'checkouts:write';
    case TRANSACTIONS_READ = 'transactions:read';
    case TRANSACTIONS_WRITE = 'transactions:write';
    case PAYOUTS_READ = 'payouts:read';
    case PAYOUTS_WRITE = 'payouts:write';
    case PRODUCTS_READ = 'products:read';
    case PRODUCTS_WRITE = 'products:write';
    case BENEFITS_READ = 'benefits:read';
    case BENEFITS_WRITE = 'benefits:write';
    case EVENTS_READ = 'events:read';
    case EVENTS_WRITE = 'events:write';
    case METERS_READ = 'meters:read';
    case METERS_WRITE = 'meters:write';
    case FILES_READ = 'files:read';
    case FILES_WRITE = 'files:write';
    case SUBSCRIPTIONS_READ = 'subscriptions:read';
    case SUBSCRIPTIONS_WRITE = 'subscriptions:write';
    case CUSTOMERS_READ = 'customers:read';
    case CUSTOMERS_WRITE = 'customers:write';
    case MEMBERS_READ = 'members:read';
    case MEMBERS_WRITE = 'members:write';
    case WALLETS_READ = 'wallets:read';
    case WALLETS_WRITE = 'wallets:write';
    case DISPUTES_READ = 'disputes:read';
    case DISPUTES_WRITE = 'disputes:write';
    case CUSTOMER_METERS_READ = 'customer_meters:read';
    case CUSTOMER_SESSIONS_WRITE = 'customer_sessions:write';
    case MEMBER_SESSIONS_WRITE = 'member_sessions:write';
    case CUSTOMER_SEATS_READ = 'customer_seats:read';
    case CUSTOMER_SEATS_WRITE = 'customer_seats:write';
    case ORDERS_READ = 'orders:read';
    case ORDERS_WRITE = 'orders:write';
    case REFUNDS_READ = 'refunds:read';
    case REFUNDS_WRITE = 'refunds:write';
    case PAYMENTS_READ = 'payments:read';
    case METRICS_READ = 'metrics:read';
    case METRICS_WRITE = 'metrics:write';
    case WEBHOOKS_READ = 'webhooks:read';
    case WEBHOOKS_WRITE = 'webhooks:write';
    case LICENSE_KEYS_READ = 'license_keys:read';
    case LICENSE_KEYS_WRITE = 'license_keys:write';
    case CUSTOMER_PORTAL_READ = 'customer_portal:read';
    case CUSTOMER_PORTAL_WRITE = 'customer_portal:write';
    case NOTIFICATIONS_READ = 'notifications:read';
    case NOTIFICATIONS_WRITE = 'notifications:write';
    case NOTIFICATION_RECIPIENTS_READ = 'notification_recipients:read';
    case NOTIFICATION_RECIPIENTS_WRITE = 'notification_recipients:write';
    case ORGANIZATION_ACCESS_TOKENS_READ = 'organization_access_tokens:read';
    case ORGANIZATION_ACCESS_TOKENS_WRITE = 'organization_access_tokens:write';
}