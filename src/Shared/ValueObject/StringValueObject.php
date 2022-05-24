<?php

namespace App\Shared\ValueObject;

class StringValueObject implements SimpleValueObject
{
    public function __construct(
        protected string $value
    ) {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
