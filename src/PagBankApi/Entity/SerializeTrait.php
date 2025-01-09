<?php

namespace PagBankApi\Entity;

trait SerializeTrait
{
    public function jsonSerialize(): mixed
    {
        $entity = clone $this;

        if (method_exists($entity, 'beforeSerialize')) {
            $entity->beforeSerialize();
        }

        $vars = $entity->toArray();
        if (method_exists($entity, 'afterSerialize')) {
            return $entity->afterSerialize($vars);
        }

        return $vars;
    }

    /** @return mixed[] */
    public function toArray(): array
    {
        $vars = get_object_vars($this);

        if ($this->hiddenNullValues()) {
            return array_filter($vars, function ($value): bool {
                return null !== $value;
            });
        }

        return $vars;
    }

    public function toJSON(bool $hiddenNull = true): string|false
    {
        if ($hiddenNull) {
            return json_encode($this);
        }

        return json_encode(get_object_vars($this));
    }

    /**
     * @param mixed[]  $body
     * @param string[] $blockFields
     */
    public function populateByArray(array $body, array $blockFields = []): static
    {
        $reflection = new \ReflectionClass($this);
        foreach ($body as $key => $value) {
            if (!$this->shouldPopulateProperty($key, $value, $blockFields)) {
                continue;
            }

            $property = $reflection->getProperty($key);
            $property->setAccessible(true);
            /**
             * @var \ReflectionNamedType|null $propertyType
             */
            $propertyType = $property->getType();

            $attributes = $property->getAttributes(PropertyMapping::class);
            /** @var PropertyMapping|null $mapping */
            $mapping = null;
            if (!empty($attributes)) {
                $mapping = $attributes[0]->newInstance();
            }

            if ($propertyType instanceof \ReflectionNamedType && !$propertyType->isBuiltin() || $mapping) {
                $className = $mapping ? $mapping->className : $propertyType?->getName();
                if (empty($className) || !is_array($value)) {
                    continue;
                }

                if (!method_exists($className, 'populateByArray')) {
                    throw new \RuntimeException("Class $className does not implement populateByArray.");
                }

                if ($mapping && $mapping->isArray()) {
                    $arrayOfObjects = [];
                    foreach ($value as $item) {
                        if (!is_array($item)) {
                            continue;
                        }
                        /** @var PagBankSerializable $nestedObject */
                        $nestedObject = new $className();
                        $nestedObject->populateByArray($item);
                        $arrayOfObjects[] = $nestedObject;
                    }
                    $property->setValue($this, $arrayOfObjects);
                } else {
                    /** @var PagBankSerializable $nestedObject */
                    $nestedObject = new $className();
                    $nestedObject->populateByArray($value);
                    $property->setValue($this, $nestedObject);
                }
            } else {
                // Simple props
                $property->setValue($this, $value);
            }
        }

        return $this;
    }

    private function hiddenNullValues(): bool
    {
        return true;
    }

    /**
     * @param string[] $blockFields
     */
    protected function shouldPopulateProperty(string $property, mixed $value, array $blockFields): bool
    {
        return property_exists($this, $property) && null !== $value && !in_array($property, $blockFields);
    }
}
