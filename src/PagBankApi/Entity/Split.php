<?php

namespace PagBankApi\Entity;

class Split implements PagBankSerializable
{
    use SerializeTrait;

    private const METHOD_PERCENTAGE = 'percentage';

    private const METHOD_FIXED = 'fixed';

    private ?string $method = null;

    /**
     * @var Receiver[]
     */
    #[PropertyMapping(className: Receiver::class, type: 'array')]
    private array $receivers = [];

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): static
    {
        if (!in_array($method, [self::METHOD_PERCENTAGE, self::METHOD_FIXED])) {
            throw new \InvalidArgumentException('Invalid split method provided');
        }
        $this->method = $method;

        return $this;
    }

    public function createReceiver(): Receiver
    {
        $receiver = new Receiver();
        $this->addReceiver($receiver);

        return $receiver;
    }

    /**
     * @return Receiver[]
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    public function addReceiver(Receiver $receiver): static
    {
        $this->receivers[] = $receiver;

        return $this;
    }

    /**
     * @param Receiver[] $receivers
     */
    public function setReceivers(array $receivers): static
    {
        $this->receivers = $receivers;

        return $this;
    }
}
