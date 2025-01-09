<?php

namespace PagBankApi\Entity;

#[\Attribute]
class PropertyMapping
{
    public const TYPE_ARRAY = 'array';

    public const TYPE_OBJECT = 'object';

    /**
     * @param class-string $className
     */
    public function __construct(
        public readonly string $className,
        public readonly string $type = self::TYPE_OBJECT,
    ) {
    }

    public function isArray(): bool
    {
        return self::TYPE_ARRAY === $this->type;
    }
}
