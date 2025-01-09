<?php

namespace PagBankApi\Service;

use PagBankApi\Entity\Amount;
use PagBankApi\Entity\CancelPayment;
use PagBankApi\Entity\Charge;
use PagBankApi\Entity\Checkout;
use PagBankApi\Entity\Order;
use PagBankApi\Entity\Payment;
use PagBankApi\Entity\PublicKey;
use PagBankApi\Http\PagBankResponse;

class PagBankService extends AbstractService
{
    public function getConnectService(): PagBankConnectService
    {
        return new PagBankConnectService($this->config, $this->logger, $this->httpClient);
    }

    public function createOrder(Order $order): Order
    {
        return $this->populateOrderResponse($this->httpClient->postRequest('/orders', $order));
    }

    public function getOrder(string $orderId): Order
    {
        return $this->populateOrderResponse($this->httpClient->getRequest("/orders/{$orderId}"));
    }

    public function getOrderByParams(string $chargeId): Order
    {
        return $this->populateOrderResponse($this->httpClient->getRequest("/orders?charge_id={$chargeId}"));
    }

    public function createPayment(string $orderId, Payment $payment): Order
    {
        return $this->populateOrderResponse($this->httpClient->postRequest("/orders/{$orderId}/pay", $payment));
    }

    public function capturePayment(string $charge_id, Amount $amount): Charge
    {
        return $this->populatePaymentResponse($this->httpClient->postRequest("/charges/{$charge_id}/capture", ['amount' => $amount]));
    }

    public function getPayment(string $charge_id): Charge
    {
        return $this->populatePaymentResponse($this->httpClient->getRequest("/charge/{$charge_id}"));
    }

    public function cancelPayment(string $charge_id, CancelPayment $cancelPayment): Charge
    {
        return $this->populatePaymentResponse($this->httpClient->postRequest("/charges/{$charge_id}/cancel", $cancelPayment));
    }

    public function createPublicKey(string $type = 'card'): PublicKey
    {
        return (new PublicKey())->populateByArray($this->httpClient->postRequest('/public-keys', ['type' => $type])->getContent());
    }

    public function getPublicKey(): PublicKey
    {
        return (new PublicKey())->populateByArray($this->httpClient->getRequest('/public-keys/card')->getContent());
    }

    public function updatePublicKey(): PublicKey
    {
        return (new PublicKey())->populateByArray($this->httpClient->putRequest('/public-keys/card')->getContent());
    }

    public function createCheckout(Checkout $checkout): Checkout
    {
        return $this->populateCheckoutResponse($this->httpClient->postRequest('/checkouts', $checkout));
    }

    public function getCheckout(string $checkout_id): Checkout
    {
        return $this->populateCheckoutResponse($this->httpClient->getRequest("/checkouts/{$checkout_id}"));
    }

    public function activateCheckout(string $checkout_id): Checkout
    {
        return $this->populateCheckoutResponse($this->httpClient->postRequest("/checkouts/{$checkout_id}/activate"));
    }

    public function inactivateCheckout(string $checkout_id): Checkout
    {
        return $this->populateCheckoutResponse($this->httpClient->postRequest("/checkouts/{$checkout_id}/inactivate"));
    }

    /**
     * @param array<string, mixed>|object $body
     * @param array<string, string>       $headers
     */
    public function customRequest(string $method, string $endpoint, array|object $body = [], array $headers = []): PagBankResponse
    {
        return $this->httpClient->sendRequest($method, $endpoint, $body, $headers);
    }

    private function populateOrderResponse(PagBankResponse $response): Order
    {
        return (new Order())
            ->populateByArray($response->getContent())
            ->setHttpResponse($response);
    }

    private function populatePaymentResponse(PagBankResponse $response): Charge
    {
        return (new Charge())
            ->populateByArray($response->getContent())
            ->setHttpResponse($response);
    }

    private function populateCheckoutResponse(PagBankResponse $response): Checkout
    {
        return (new Checkout())
            ->populateByArray($response->getContent())
            ->setHttpResponse($response);
    }
}
