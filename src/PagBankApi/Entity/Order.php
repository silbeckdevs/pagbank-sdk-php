<?php

namespace PagBankApi\Entity;

class Order implements PagBankSerializable
{
    use SerializeTrait;
    use ResponseTrait;

    private ?string $id = null;

    private ?string $reference_id = null;

    private ?Customer $customer = null;

    private ?Shipping $shipping = null;

    /**
     * @var Item[]
     */
    #[PropertyMapping(className: Item::class, type: 'array')]
    private array $items = [];

    /**
     * @var Charge[]|null
     */
    #[PropertyMapping(className: Charge::class, type: 'array')]
    private ?array $charges = null;

    /**
     * @var string[]|null
     */
    private ?array $notification_urls = null;

    /**
     * @var QrCode[]|null
     * */
    #[PropertyMapping(className: QrCode::class, type: 'array')]
    private ?array $qr_codes = null;

    /**
     * @var Link[]|null
     */
    #[PropertyMapping(className: Link::class, type: 'array')]
    private ?array $links = null;

    private ?string $created_at = null;

    public function generatePayment(): Payment
    {
        if (empty($this->getCharges())) {
            throw new \RuntimeException('Empty charges');
        }

        $payment = new Payment();
        $payment->setCharges($this->getCharges());

        return $payment;
    }

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

    public function createCharge(): Charge
    {
        if (is_null($this->charges)) {
            $this->charges = [];
        }

        $charge = new Charge();
        $this->charges[] = $charge;

        return $charge;
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

    public function createQrCode(): QrCode
    {
        if (is_null($this->qr_codes)) {
            $this->qr_codes = [];
        }

        $qrcode = new QrCode();
        $this->qr_codes[] = $qrcode;

        return $qrcode;
    }

    /**
     * @return QrCode[]|null
     */
    public function getQrCodes(): ?array
    {
        return $this->qr_codes;
    }

    /**
     * @param QrCode[] $qr_codes
     */
    public function setQrCodes(array $qr_codes): static
    {
        $this->qr_codes = $qr_codes;

        return $this;
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

    /**
     * @param Charge[] $charges
     */
    public function setCharges(array $charges): static
    {
        $this->charges = $charges;

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
     * @return Charge[]|null
     */
    public function getCharges(): ?array
    {
        return $this->charges;
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
}
