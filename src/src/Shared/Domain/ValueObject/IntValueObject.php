<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    public function __construct(private int $value) {}

    public function value(): int {
        return $this->value;
    }
}
