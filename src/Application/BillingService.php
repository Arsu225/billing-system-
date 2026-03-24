<?php

namespace App\Application;

use App\Infrastructure\InvoiceRepository;
use App\Domain\PaymentGatewayInterface;
class BillingService
{
    private InvoiceRepository $invoiceRepo;
    private PaymentGatewayInterface $gateway;
 public function __construct(
    InvoiceRepository $invoiceRepo,
    PaymentGatewayInterface $gateway
) {
    $this->invoiceRepo = $invoiceRepo;
    $this->gateway = $gateway;
}

    public function generateInvoice($amount)
    {
        $invoiceId = uniqid();
        $dueDate = date('Y-m-d', strtotime('+3 days'));

        $this->invoiceRepo->createInvoice(
            $invoiceId,
            $amount,
            'pending',
            $dueDate
        );

        $this->invoiceRepo->addItem(
            $invoiceId,
            "Monthly Subscription",
            $amount
        );
    }

    // 👇 YE NAYA FUNCTION ADD KARO
    public function calculateProration($oldPrice, $newPrice, $usedDays, $totalDays)
    {
        $remainingDays = $totalDays - $usedDays;

        $unusedAmount = ($remainingDays / $totalDays) * $oldPrice;

        $finalCharge = $newPrice - $unusedAmount;

        return (int) $finalCharge;
    }
public function upgradePlan($oldPrice, $newPrice, $usedDays, $totalDays)
{
    // proration calculate karo
    $amountToCharge = $this->calculateProration(
        $oldPrice,
        $newPrice,
        $usedDays,
        $totalDays
    );

    // invoice generate karo
    $this->generateInvoice($amountToCharge);

    return $amountToCharge;
}
public function downgradePlan($oldPrice, $usedDays, $totalDays)
{
    $remainingDays = $totalDays - $usedDays;

    // unused amount (credit)
    $credit = intdiv($remainingDays * $oldPrice, $totalDays);

    return $credit;
}
public function applyCredit($amount, $creditBalance)
{
    if ($creditBalance <= 0) {
        return $amount;
    }

    if ($creditBalance >= $amount) {
        return 0;
    }

    return $amount - $creditBalance;
}

public function calculateOverage($activeUsers, $maxUsers)
{
    if ($activeUsers <= $maxUsers) {
        return 0;
    }

    $extraUsers = $activeUsers - $maxUsers;

    return $extraUsers * 19900; // ₹199 = 19900 paise
}
public function chargeWithRetry(int $amount)
{
    $attempts = 0;
    $delays = [60, 300, 900]; // seconds

    while ($attempts < 3) {
        $success = $this->gateway->charge($amount);

        if ($success) {
            return true;
        }

        sleep($delays[$attempts]);
        $attempts++;
    }

    return false;
}
}

