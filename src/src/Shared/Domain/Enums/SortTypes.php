<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Enums;

use Src\DoctorSlots\Application\sort\{SortByDateAndTime, SortBySlotDuration};

abstract class SortTypes
{
    const SORT_TYPES = [
        'duration' => SortBySlotDuration::class,
        'date_and_time' => SortByDateAndTime::class
    ];
}
