<?php

namespace PagBankApi\Entity;

class Charge implements PagBankSerializable
{
    use SerializeTrait;
    use ResponseTrait;

    public const STATUS_AUTHORIZED = 'AUTHORIZED';

    public const STATUS_PAID = 'PAID';

    public const STATUS_IN_ANALYSIS = 'IN_ANALYSIS';

    public const STATUS_DECLINED = 'DECLINED';

    public const STATUS_CANCELED = 'CANCELED';

    public const STATUS_WAITING = 'WAITING';

    private ?string $id = null;

    private ?string $reference_id = null;

    private ?string $description = null;

    private ?Amount $amount = null;

    private ?PaymentMethod $payment_method = null;

    private ?Split $splits = null;

    private ?string $status = null;

    private ?string $created_at = null;

    private ?string $paid_at = null;

    private ?PaymentResponse $payment_response = null;

    /**
     * @var Link[]|null
     */
    #[PropertyMapping(className: Link::class, type: 'array')]
    private ?array $links = null;

    /**
     * @var string[]|null
     */
    private ?array $notification_urls = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function createSplit(): Split
    {
        return $this->splits = new Split();
    }

    public function getSplit(): ?Split
    {
        return $this->splits;
    }

    public function setSplit(Split $split): static
    {
        $this->splits = $split;

        return $this;
    }

    public function createAmount(?int $value = null): Amount
    {
        return $this->amount = new Amount($value);
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->payment_method;
    }

    public function createPaymentMethod(): PaymentMethod
    {
        return $this->payment_method = new PaymentMethod();
    }

    public function getReferenceId(): ?string
    {
        return $this->reference_id;
    }

    public function setReferenceId(?string $reference_id): static
    {
        $this->reference_id = $reference_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function setAmount(?int $value): static
    {
        $this->amount = new Amount($value);

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getPaidAt(): ?string
    {
        return $this->paid_at;
    }

    public function getPaymentResponse(): ?PaymentResponse
    {
        return $this->payment_response;
    }

    /**
     * @return Link[]|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @return string[]|null
     */
    public function getNotificationUrls(): ?array
    {
        return $this->notification_urls;
    }
}
