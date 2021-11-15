<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Contracts;

use Src\DoctorSlots\Domain\DoctorSlots;

interface SlotsSorter
{
    public function sortingBySlotDuration(string $date_from, string $date_to): ?DoctorSlots;
    public function sortingBySlotDateAndTime(string $date_from, string $date_to): ?DoctorSlots;
}
