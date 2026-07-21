<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Services\CustomerPortal\BenefitGrantsService;
use Pago\V2026_04\Services\CustomerPortal\CustomerMetersService;
use Pago\V2026_04\Services\CustomerPortal\CustomerSessionService;
use Pago\V2026_04\Services\CustomerPortal\CustomersService;
use Pago\V2026_04\Services\CustomerPortal\DownloadablesService;
use Pago\V2026_04\Services\CustomerPortal\LicenseKeysService;
use Pago\V2026_04\Services\CustomerPortal\MembersService;
use Pago\V2026_04\Services\CustomerPortal\OrdersService;
use Pago\V2026_04\Services\CustomerPortal\OrganizationsService;
use Pago\V2026_04\Services\CustomerPortal\SeatsService;
use Pago\V2026_04\Services\CustomerPortal\SubscriptionsService;
use Pago\V2026_04\Services\CustomerPortal\WalletsService;

/**
 * CustomerPortal operations.
 */
final class CustomerPortalService
{
    public readonly BenefitGrantsService $benefitGrants;
    public readonly CustomersService $customers;
    public readonly CustomerMetersService $customerMeters;
    public readonly SeatsService $seats;
    public readonly CustomerSessionService $customerSession;
    public readonly DownloadablesService $downloadables;
    public readonly LicenseKeysService $licenseKeys;
    public readonly MembersService $members;
    public readonly OrdersService $orders;
    public readonly OrganizationsService $organizations;
    public readonly SubscriptionsService $subscriptions;
    public readonly WalletsService $wallets;

    public function __construct(private readonly Transport $transport)
    {
        $this->benefitGrants = new BenefitGrantsService($transport);
        $this->customers = new CustomersService($transport);
        $this->customerMeters = new CustomerMetersService($transport);
        $this->seats = new SeatsService($transport);
        $this->customerSession = new CustomerSessionService($transport);
        $this->downloadables = new DownloadablesService($transport);
        $this->licenseKeys = new LicenseKeysService($transport);
        $this->members = new MembersService($transport);
        $this->orders = new OrdersService($transport);
        $this->organizations = new OrganizationsService($transport);
        $this->subscriptions = new SubscriptionsService($transport);
        $this->wallets = new WalletsService($transport);
    }
}