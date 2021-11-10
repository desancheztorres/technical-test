<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Contracts;

interface SlotsSorter
{
    public function sortingBySlotDuration($date_from, $date_to);
    public function sortingBySlotDateAndTime($date_from, $date_to);
}
