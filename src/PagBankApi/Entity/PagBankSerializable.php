<?php

namespace PagBankApi\Entity;

interface PagBankSerializable extends \JsonSerializable
{
    /**  @return mixed[] */
    public function toArray(): array;

    public function toJSON(bool $hiddenNull = true): string|false;

    /**
     * @param mixed[]  $body
     * @param string[] $blockFields
     */
    public function populateByArray(array $body, array $blockFields = []): static;
}
