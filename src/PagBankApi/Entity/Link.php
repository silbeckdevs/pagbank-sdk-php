<?php

namespace PagBankApi\Entity;

class Link implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $rel = null;

    private ?string $href = null;

    private ?string $media = null;

    private ?string $type = null;

    public function getRel(): ?string
    {
        return $this->rel;
    }

    public function setRel(string $rel): static
    {
        $this->rel = $rel;

        return $this;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHref(string $href): static
    {
        $this->href = $href;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
