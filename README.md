# Pago PHP SDK

The official PHP SDK for the [Pago](https://pago.sh) API.

> This package is generated from the Pago OpenAPI specification. Do not edit it by hand.

## Requirements

- PHP 8.2 or newer
- A [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client and a
  [PSR-17](https://www.php-fig.org/psr/psr-17/) factory (auto-discovered)

## Installation

```bash
composer require pago-sh/sdk
```

If you do not already have a PSR-18 client installed, add one:

```bash
composer require guzzlehttp/guzzle
```

## Usage

```php
<?php

require 'vendor/autoload.php';

$pago = Pago\Client::create('pago_pat_...');

$order = $pago->orders->get('018f...');

echo $order->id;
```

To pin an API version explicitly, or to point the client at the sandbox:

```php
$pago = Pago\Client::v2026_04(
    accessToken: 'pago_pat_...',
    baseUrl: 'https://sandbox-api.pago.sh',
);
```

### Bring your own HTTP client

Any PSR-18 implementation works, and it can be injected explicitly:

```php
$pago = Pago\Client::create(
    accessToken: 'pago_pat_...',
    httpClient: new GuzzleHttp\Client(['timeout' => 10]),
);
```

### Pagination

List endpoints return one page at a time. Every one of them also has a
`...Paginated()` variant that returns a lazy iterator over *all* pages —
requests are only issued as you consume items:

```php
foreach ($pago->orders->listPaginated(organizationId: $organizationId) as $order) {
    echo $order->id, PHP_EOL;
}
```

### Errors

Every failure mode is an exception under `Pago\Exception`:

| Exception | Raised when |
| --- | --- |
| `PagoNetworkException` | the request never reached the API |
| `PagoServerException` | the API returned 5xx |
| `PagoApiException` | the API returned 4xx |
| `PagoRateLimitException` | the API returned 429 (exposes `retryAfter`) |
| `PagoSerializationException` | a payload did not match its schema |

Endpoints that document specific error bodies raise a dedicated subclass of
`PagoApiException` carrying the decoded body:

```php
use Pago\Exception\PagoApiException;

try {
    $order = $pago->orders->get($id);
} catch (PagoApiException $exception) {
    echo $exception->statusCode;
}
```

### Webhooks

`validateEvent()` verifies the
[Standard Webhooks](https://www.standardwebhooks.com/) signature and returns a
typed payload. Pass the **raw** request body — any reserialization invalidates
the signature.

The secret is the endpoint signing secret exactly as shown in the dashboard,
`whsec_` prefix included. A secret in any other shape raises a verification
exception describing the problem, rather than failing as a bad signature.

```php
use Pago\V2026_04\Webhooks;

$payload = Webhooks::validateEvent(
    body: file_get_contents('php://input'),
    headers: getallheaders(),
    secret: getenv('PAGO_WEBHOOK_SECRET'),
);

echo $payload->type;
```

## License

MIT