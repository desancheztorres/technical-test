<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Enums;

use Src\DoctorSlots\Application\sort\SortByDateAndTime;
use Src\DoctorSlots\Application\sort\SortBySlotDuration;

abstract class SortTypes
{
    const SORT_TYPES = [
        'duration' => SortBySlotDuration::class,
        'date_and_time' => SortByDateAndTime::class
    ];
}
