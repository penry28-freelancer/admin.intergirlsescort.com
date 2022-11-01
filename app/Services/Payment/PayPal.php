<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGateway;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\NameValuePair;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal implements PaymentGateway
{
    private ApiContext $_apiContext;
    private string $_currency;
    private string $_returnUrl;
    private string $_cancelUrl;
    private float $_totalAmount = 0;
    private array $_items = [];

    public function __construct(array $configs = [])
    {
        $configs = !empty(config('paypal')) ? config('paypal') : $configs;

        $this->_setApiContext($configs);
    }

    /**
     * @throws \Exception
     */
    public function createPayment($description)
    {
        $checkoutUrl = false;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();
        $itemList->setItems($this->_items);

        $amount = new Amount();
        $amount->setCurrency($this->_currency)
            ->setTotal($this->_totalAmount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($description);

        $redirectUrls = new RedirectUrls();

        if (is_null($this->_cancelUrl)) {
            $this->_cancelUrl = $this->_returnUrl;
        }

        $redirectUrls->setReturnUrl($this->_returnUrl)
            ->setCancelUrl($this->_cancelUrl);

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->_apiContext);
        } catch (\Exception $paypalException) {
            throw new \Exception($paypalException->getMessage());
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $checkoutUrl = $link->getHref();
                break;
            }
        }

        return $checkoutUrl;
    }

    public function getPaymentStatus($paymentId)
    {
        $payment = Payment::get($paymentId, $this->_apiContext);

        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId(request('PayerID'));

        return $payment->execute($paymentExecution, $this->_apiContext);
    }

    public function getPaymentDetail($paymentId): array
    {
        $payment = Payment::get($paymentId, $this->_apiContext);
        return $payment->getTransactions();
    }

    public function setItems($data): self
    {
        if (count($data) === count($data, COUNT_RECURSIVE)) {
            $data = [$data];
        }

        foreach ($data as $order) {
            $item = new Item();

            $item->setName($order['name'])
                ->setSku($order['transaction'])
                ->setCurrency($this->_currency)
                ->setQuantity($order['quantity'])
                ->setPrice($order['price']);

            $this->_items[] = $item;
            $this->_totalAmount += $order['price'] * $order['quantity'];
        }

        return $this;
    }

    public function getItems(): array
    {
        return $this->_items;
    }

    public function getTotalAmount(): float
    {
        return $this->_totalAmount;
    }

    public function setCurrency($currency): PayPal
    {
        $this->_currency = $currency;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->_currency;
    }

    public function setReturnUrl($returnUrl): PayPal
    {
        $this->_returnUrl = $returnUrl;
        return $this;
    }

    public function getReturnUrl(): string
    {
        return $this->_returnUrl;
    }

    public function setCancelUrl($cancelUrl): PayPal
    {
        $this->_cancelUrl = $cancelUrl;
        return $this;
    }
    public function getCancelUrl(): string
    {
        return $this->_cancelUrl;
    }

    private function _setApiContext($configs)
    {
        $mode = $this->_getValidPaymentMode($configs);

        $this->_apiContext = new ApiContext(
            new OAuthTokenCredential(
                $configs[$mode]['client_id'],
                $configs[$mode]['secret']
            )
        );
    }

    private function _getValidPaymentMode($configs): string
    {
        $mode = $configs['mode'];
        return in_array($mode, ['sandbox', 'live']) ? $mode : 'sandbox';
    }

}
