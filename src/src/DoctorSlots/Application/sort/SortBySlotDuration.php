<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Application\sort;

use Src\DoctorSlots\Domain\Contracts\SlotsSorter;

final class SortBySlotDuration
{
    public function __construct(private SlotsSorter $slotsSorter) {}

    public function __invoke()
    {
        return $this->slotsSorter->sortingBySlotDuration();
    }
}
