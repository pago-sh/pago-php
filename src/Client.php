<?php

declare(strict_types=1);

namespace Pago;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Entry point for the Pago SDK.
 *
 * Each API version has its own client; `create()` returns the newest one.
 *
 * ```php
 * $pago = Pago\Client::create('pago_pat_...');
 * $order = $pago->orders->get('order_id');
 * ```
 */
final class Client
{
    public const VERSION_V2026_04 = '2026-04';

    /**
     * Build a client for the newest supported API version (2026-04).
     */
    public static function create(
        string $accessToken,
        ?string $baseUrl = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ): V2026_04\Client {
        return new V2026_04\Client(
            $accessToken,
            $baseUrl,
            $httpClient,
            $requestFactory,
            $streamFactory,
        );
    }

    /**
     * Build a client pinned to API version 2026-04.
     */
    public static function v2026_04(
        string $accessToken,
        ?string $baseUrl = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ): V2026_04\Client {
        return new V2026_04\Client(
            $accessToken,
            $baseUrl,
            $httpClient,
            $requestFactory,
            $streamFactory,
        );
    }
}