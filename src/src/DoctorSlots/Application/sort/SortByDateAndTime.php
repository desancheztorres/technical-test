<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Application\sort;

use Src\DoctorSlots\Domain\Contracts\SlotsSorter;

final class SortByDateAndTime
{
    public function __construct(
        private SlotsSorter $slotsSorter,
        private $date_from,
        private $date_to
    ) {}

    public function __invoke()
    {
        return $this->slotsSorter->sortingBySlotDateAndTime($this->date_from, $this->date_to);
    }
}
