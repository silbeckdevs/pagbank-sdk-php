<?php

namespace PagBankApi\Entity;

class QrCode implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $id = null;

    private ?string $text = null;

    /**
     * @var Link[]|null
     */
    #[PropertyMapping(className: Link::class, type: 'array')]
    private ?array $links = null;

    private ?Amount $amount = null;

    private ?string $expiration_date = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setAmount(int $value): static
    {
        $this->amount = new Amount($value);

        return $this;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function createLink(): Link
    {
        if (is_null($this->links)) {
            $this->links = [];
        }

        $link = new Link();
        $this->links[] = $link;

        return $link;
    }

    public function setExpirationDate(string $expiration_date): static
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
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
}
