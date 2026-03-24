<?php

use PHPUnit\Framework\TestCase;
use App\Application\BillingService;
use App\Infrastructure\InvoiceRepository;
use App\Infrastructure\MockGateway;

class BillingTest extends TestCase
{
    public function testProration()
    {
        $service = new BillingService(new InvoiceRepository(), new MockGateway());

        $result = $service->calculateProration(99900, 299900, 10, 30);

        $this->assertEquals(233300, $result);
    }

    public function testOverage()
    {
        $service = new BillingService(new InvoiceRepository(), new MockGateway());

        $result = $service->calculateOverage(8, 5);

        $this->assertEquals(59700, $result);
    }
}