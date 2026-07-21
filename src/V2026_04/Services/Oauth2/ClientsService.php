<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\Oauth2;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Services\Oauth2\Clients\Oauth2Service;

/**
 * Clients operations.
 */
final class ClientsService
{
    public readonly Oauth2Service $oauth2;

    public function __construct(private readonly Transport $transport)
    {
        $this->oauth2 = new Oauth2Service($transport);
    }
}