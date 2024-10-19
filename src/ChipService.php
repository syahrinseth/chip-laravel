<?php

namespace SyahrinSeth\ChipLaravel;

use Chip\Model\ClientDetails;
use Chip\Model\Product;
use Chip\Model\Purchase;
use Chip\Model\PurchaseDetails;
use Symfony\Component\Process\Exception\InvalidArgumentException;

class ChipService
{
    protected $chip;

    public function __construct()
    {
        $this->chip = app('chiplaravel');
    }

    public function createPurchase($email, array $products, $successRedirect, $failureRedirect, $successCallback)
    {
        $client = new ClientDetails();
        $client->email = $email;

        $purchase = new Purchase();
        $purchase->client = $client;

        $details = new PurchaseDetails();

        $chip_products = [];
        for ($i = 0; $i < count($products); $i++) {
            if ($products[$i] instanceof Product) {
                array_push($chip_products, $products[$i]);
            } else {
                throw new InvalidArgumentException("Expected Product instance.");
            }
        }
        $details->products = $chip_products;

        $purchase->purchase = $details;
        $purchase->brand_id = config('chiplaravel.brand_id');
        $purchase->success_redirect = $successRedirect;
        $purchase->success_callback = $successCallback;
        $purchase->failure_redirect = $failureRedirect;

        $result = $this->chip->createPurchase($purchase);

        if ($result) {
            return $result;
        }

        throw new \Exception('Failed to create a purchase');
    }
}
