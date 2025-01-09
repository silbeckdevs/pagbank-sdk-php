<?php

namespace PagBankApi\Entity;

class Authentication implements PagBankSerializable
{
    use SerializeTrait;

    public const TYPE_THREEDS = 'THREEDS';

    public const TYPE_INAPP = 'INAPP';

    private ?string $type = null;

    private ?string $cavv = null;

    private ?string $eci = null;

    private ?string $xid = null;

    private ?string $version = null;

    private ?string $dstrans_id = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        if (!in_array($type, [self::TYPE_THREEDS, self::TYPE_INAPP], true)) {
            throw new \InvalidArgumentException("Invalid 'Authentication_method' type: {$type}. Must be 'THREEDS' or 'INAPP'.");
        }
        $this->type = $type;

        return $this;
    }

    public function getCavv(): ?string
    {
        return $this->cavv;
    }

    public function setCavv(string $cavv): static
    {
        $this->cavv = $cavv;

        return $this;
    }

    public function getEci(): ?string
    {
        return $this->eci;
    }

    public function setEci(string $eci): static
    {
        $this->eci = $eci;

        return $this;
    }

    public function getXid(): ?string
    {
        return $this->xid;
    }

    public function setXid(?string $xid): static
    {
        $this->xid = $xid;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getDstransId(): ?string
    {
        return $this->dstrans_id;
    }

    public function setDstransId(?string $dstrans_id): static
    {
        $this->dstrans_id = $dstrans_id;

        return $this;
    }
}
