<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use InvalidArgumentException;

abstract class IdValueObject
{
    private int $value;

    public function __construct(int $id)
    {
//        $this->validate($id);
        $this->value = $id;
    }

    private function validate(int $id): void
    {
        $options = array(
            'options' => array(
                'min_range' => 0,
            )
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', IdValueObject::class, $id)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}
