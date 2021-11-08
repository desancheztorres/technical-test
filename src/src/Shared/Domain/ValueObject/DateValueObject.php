<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use DateTime;

abstract class DateValueObject
{
    public function __construct(private ?DateTime $value) {}

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
