<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(private string $value) {}

    public function value(): string {
        return $this->value;
    }
}
