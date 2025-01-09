<?php

namespace PagBankApi\Entity;

interface PagBankUnserializableArray
{
    /** @param mixed[] $body */
    public function arrayUnserialize(array $body): static;
}
