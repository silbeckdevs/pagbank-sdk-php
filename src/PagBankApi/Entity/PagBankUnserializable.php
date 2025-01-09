<?php

namespace PagBankApi\Entity;

interface PagBankUnserializable extends \JsonSerializable
{
    public function jsonUnserialize(string $serialized): static;
}
