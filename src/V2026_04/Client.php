<?php

declare(strict_types=1);

namespace Pago\V2026_04;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Pago\Http\Transport;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Pago\V2026_04\Services\OrganizationsService;
use Pago\V2026_04\Services\SubscriptionsService;
use Pago\V2026_04\Services\Oauth2Service;
use Pago\V2026_04\Services\BenefitsService;
use Pago\V2026_04\Services\BenefitGrantsService;
use Pago\V2026_04\Services\WebhooksService;
use Pago\V2026_04\Services\ProductsService;
use Pago\V2026_04\Services\OrdersService;
use Pago\V2026_04\Services\RefundsService;
use Pago\V2026_04\Services\DisputesService;
use Pago\V2026_04\Services\CheckoutsService;
use Pago\V2026_04\Services\FilesService;
use Pago\V2026_04\Services\MetricsService;
use Pago\V2026_04\Services\LicenseKeysService;
use Pago\V2026_04\Services\CheckoutLinksService;
use Pago\V2026_04\Services\CustomFieldsService;
use Pago\V2026_04\Services\DiscountsService;
use Pago\V2026_04\Services\CustomersService;
use Pago\V2026_04\Services\MembersService;
use Pago\V2026_04\Services\CustomerPortalService;
use Pago\V2026_04\Services\CustomerSeatsService;
use Pago\V2026_04\Services\CustomerSessionsService;
use Pago\V2026_04\Services\EventsService;
use Pago\V2026_04\Services\EventTypesService;
use Pago\V2026_04\Services\MetersService;
use Pago\V2026_04\Services\CustomerMetersService;
use Pago\V2026_04\Services\PaymentsService;

/**
 * Client for version 2026-04 of the Pago API.
 */
final class Client
{
    public const API_VERSION = '2026-04';
    public const DEFAULT_BASE_URL = 'https://api.pago.sh';

    public readonly OrganizationsService $organizations;
    public readonly SubscriptionsService $subscriptions;
    public readonly Oauth2Service $oauth2;
    public readonly BenefitsService $benefits;
    public readonly BenefitGrantsService $benefitGrants;
    public readonly WebhooksService $webhooks;
    public readonly ProductsService $products;
    public readonly OrdersService $orders;
    public readonly RefundsService $refunds;
    public readonly DisputesService $disputes;
    public readonly CheckoutsService $checkouts;
    public readonly FilesService $files;
    public readonly MetricsService $metrics;
    public readonly LicenseKeysService $licenseKeys;
    public readonly CheckoutLinksService $checkoutLinks;
    public readonly CustomFieldsService $customFields;
    public readonly DiscountsService $discounts;
    public readonly CustomersService $customers;
    public readonly MembersService $members;
    public readonly CustomerPortalService $customerPortal;
    public readonly CustomerSeatsService $customerSeats;
    public readonly CustomerSessionsService $customerSessions;
    public readonly EventsService $events;
    public readonly EventTypesService $eventTypes;
    public readonly MetersService $meters;
    public readonly CustomerMetersService $customerMeters;
    public readonly PaymentsService $payments;

    /**
     * @param string                        $accessToken    a Pago access token
     * @param string|null                   $baseUrl        defaults to the production API
     * @param ClientInterface|null          $httpClient     any PSR-18 client; auto-discovered when omitted
     * @param RequestFactoryInterface|null  $requestFactory any PSR-17 factory; auto-discovered when omitted
     * @param StreamFactoryInterface|null   $streamFactory  any PSR-17 factory; auto-discovered when omitted
     */
    public function __construct(
        string $accessToken,
        ?string $baseUrl = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $transport = new Transport(
            $httpClient ?? Psr18ClientDiscovery::find(),
            $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory(),
            $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory(),
            rtrim($baseUrl ?? self::DEFAULT_BASE_URL, '/'),
            $accessToken,
            self::API_VERSION,
        );

        $this->organizations = new OrganizationsService($transport);
        $this->subscriptions = new SubscriptionsService($transport);
        $this->oauth2 = new Oauth2Service($transport);
        $this->benefits = new BenefitsService($transport);
        $this->benefitGrants = new BenefitGrantsService($transport);
        $this->webhooks = new WebhooksService($transport);
        $this->products = new ProductsService($transport);
        $this->orders = new OrdersService($transport);
        $this->refunds = new RefundsService($transport);
        $this->disputes = new DisputesService($transport);
        $this->checkouts = new CheckoutsService($transport);
        $this->files = new FilesService($transport);
        $this->metrics = new MetricsService($transport);
        $this->licenseKeys = new LicenseKeysService($transport);
        $this->checkoutLinks = new CheckoutLinksService($transport);
        $this->customFields = new CustomFieldsService($transport);
        $this->discounts = new DiscountsService($transport);
        $this->customers = new CustomersService($transport);
        $this->members = new MembersService($transport);
        $this->customerPortal = new CustomerPortalService($transport);
        $this->customerSeats = new CustomerSeatsService($transport);
        $this->customerSessions = new CustomerSessionsService($transport);
        $this->events = new EventsService($transport);
        $this->eventTypes = new EventTypesService($transport);
        $this->meters = new MetersService($transport);
        $this->customerMeters = new CustomerMetersService($transport);
        $this->payments = new PaymentsService($transport);
    }
}