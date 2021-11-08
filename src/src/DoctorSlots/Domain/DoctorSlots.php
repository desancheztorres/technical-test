<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain;

final class DoctorSlots
{
    private array $slots;

    public function __construct(DoctorSlot ...$slot){
        $this->slots = $slot;
    }

    public function add(DoctorSlot $slot): void {
        $this->slots[] = $slot;
    }

    public function all(): array {
        return $this->slots;
    }
}
