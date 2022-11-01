<?php

namespace App\Contracts;

interface PaymentGateway
{
    public function createPayment($description);

    public function setCurrency($currency): PaymentGateway;

    public function getCurrency(): string;

    public function setReturnUrl($returnUrl): PaymentGateway;

    public function getReturnUrl(): string;

    public function setCancelUrl($cancelUrl): PaymentGateway;

    public function getCancelUrl(): string;

    public function setItems($data);

    public function getPaymentStatus($paymentId);

    public function getPaymentDetail($paymentId);
}
