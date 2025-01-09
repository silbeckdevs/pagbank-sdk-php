<?php

namespace PagBankApi\Entity\Connect;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class Application implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $name = null;

    private ?string $description = null;

    private ?string $site = null;

    private ?string $redirect_uri = null;

    private ?string $logo = null;

    // Api props
    private ?string $client_id = null;

    private ?string $client_secret = null;

    private ?string $account_id = null;

    private ?string $client_type = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): static
    {
        $this->site = $site;

        return $this;
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirect_uri;
    }

    public function setRedirectUri(?string $redirect_uri): static
    {
        $this->redirect_uri = $redirect_uri;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->client_id;
    }

    public function getClientSecret(): ?string
    {
        return $this->client_secret;
    }

    public function getAccountId(): ?string
    {
        return $this->account_id;
    }

    public function getClientType(): ?string
    {
        return $this->client_type;
    }
}
