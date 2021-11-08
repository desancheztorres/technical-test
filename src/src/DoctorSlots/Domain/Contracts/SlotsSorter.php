<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Contracts;

interface SlotsSorter
{
    public function sortingBySlotDuration();
    public function sortingBySlotDateAndTime();
}
