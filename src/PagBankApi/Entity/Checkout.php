<?php

namespace PagBankApi\Entity;

class Checkout implements PagBankSerializable
{
    use SerializeTrait;
    use ResponseTrait;

    public const STATUS_ACTIVE = 'ACTIVE';

    public const STATUS_INACTIVE = 'INACTIVE';

    public const STATUS_EXPIRED = 'EXPIRED';

    private ?string $id = null;

    private ?string $status = null;

    private ?string $reference_id = null;

    private ?string $expiration_date = null;

    private ?Customer $customer = null;

    private ?bool $customer_modifiable = null;

    /**
     * @var Item[]
     */
    #[PropertyMapping(className: Item::class, type: 'array')]
    private array $items = [];

    private ?int $additional_amount = null;

    private ?int $discount_amount = null;

    private ?Shipping $shipping = null;

    /**
     * @var CheckoutPaymentMethod[]|null
     */
    #[PropertyMapping(className: CheckoutPaymentMethod::class, type: 'array')]
    private ?array $payment_methods = null;

    /**
     * @var CheckoutPaymentMethodConfig[]|null
     */
    #[PropertyMapping(className: CheckoutPaymentMethodConfig::class, type: 'array')]
    private ?array $payment_methods_configs = null;

    private ?string $soft_descriptor = null;

    private ?string $redirect_url = null;

    private ?string $return_url = null;

    /**
     * @var string[]|null
     */
    private ?array $notification_urls = null;

    /**
     * @var string[]|null
     */
    private ?array $payment_notification_urls = null;

    /**
     * @var Link[]|null
     */
    #[PropertyMapping(className: Link::class, type: 'array')]
    private ?array $links = null;

    private ?string $created_at = null;

    /**
     * @var CheckoutOrder[]|null
     */
    #[PropertyMapping(className: CheckoutOrder::class, type: 'array')]
    private ?array $orders = null;

    // gets and sets
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Link[]|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     */
    public function setLinks(array $links): static
    {
        $this->links = $links;

        return $this;
    }

    public function createShipping(): Shipping
    {
        return $this->shipping = new Shipping();
    }

    public function createItem(): Item
    {
        $item = new Item();
        $this->addItem($item);

        return $item;
    }

    public function createCustomer(): Customer
    {
        return $this->customer = new Customer();
    }

    public function addItem(Item $item): static
    {
        $this->items[] = $item;

        return $this;
    }

    public function setShipping(Shipping $shipping): static
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function setOrderId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->id;
    }

    public function getReferenceId(): ?string
    {
        return $this->reference_id;
    }

    public function setReferenceId(string $reference_id): static
    {
        $this->reference_id = $reference_id;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    /**
     * Get the items in the order.
     *
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string[]|null
     */
    public function getNotificationUrls(): ?array
    {
        return $this->notification_urls;
    }

    /**
     * @param string[] $notification_urls
     */
    public function setNotificationUrls(array $notification_urls): static
    {
        $this->notification_urls = $notification_urls;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(?string $expiration_date): static
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getAdditionalAmount(): ?int
    {
        return $this->additional_amount;
    }

    public function setAdditionalAmount(?int $additional_amount): static
    {
        $this->additional_amount = $additional_amount;

        return $this;
    }

    public function getDiscountAmount(): ?int
    {
        return $this->discount_amount;
    }

    public function setDiscountAmount(?int $discount_amount): static
    {
        $this->discount_amount = $discount_amount;

        return $this;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->soft_descriptor;
    }

    public function setSoftDescriptor(?string $soft_descriptor): static
    {
        $this->soft_descriptor = $soft_descriptor;

        return $this;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirect_url;
    }

    public function setRedirectUrl(?string $redirect_url): static
    {
        $this->redirect_url = $redirect_url;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getPaymentNotificationUrls(): ?array
    {
        return $this->payment_notification_urls;
    }

    /**
     * @param string[] $payment_notification_urls
     */
    public function setPaymentNotificationUrls(array $payment_notification_urls): static
    {
        $this->payment_notification_urls = $payment_notification_urls;

        return $this;
    }

    public function getReturnUrl(): ?string
    {
        return $this->return_url;
    }

    public function setReturnUrl(?string $return_url): static
    {
        $this->return_url = $return_url;

        return $this;
    }

    /**
     * @return CheckoutPaymentMethod[]|null
     */
    public function getPaymentMethods(): ?array
    {
        return $this->payment_methods;
    }

    /**
     * @param CheckoutPaymentMethod[] $payment_methods
     */
    public function setPaymentMethods(array $payment_methods): static
    {
        $this->payment_methods = $payment_methods;

        return $this;
    }

    /**
     * @return CheckoutPaymentMethodConfig[]|null
     */
    public function getPaymentMethodsConfigs(): ?array
    {
        return $this->payment_methods_configs;
    }

    /**
     * @param CheckoutPaymentMethodConfig[] $payment_methods_configs
     */
    public function setPaymentMethodsConfigs(?array $payment_methods_configs): static
    {
        $this->payment_methods_configs = $payment_methods_configs;

        return $this;
    }

    public function getCustomerModifiable(): ?bool
    {
        return $this->customer_modifiable;
    }

    public function setCustomerModifiable(?bool $customer_modifiable): static
    {
        $this->customer_modifiable = $customer_modifiable;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return CheckoutOrder[]|null
     */
    public function getOrders(): ?array
    {
        return $this->orders;
    }

    /**
     * @param CheckoutOrder[] $orders
     */
    public function setOrders(?array $orders): static
    {
        $this->orders = $orders;

        return $this;
    }
}
