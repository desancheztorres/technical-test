<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Src\Doctor\Domain\DoctorId;
use Src\DoctorSlots\Domain\Contracts\SlotsSorter;
use Src\DoctorSlots\Domain\DoctorSlot;
use Src\DoctorSlots\Domain\DoctorSlotEnd;
use Src\DoctorSlots\Domain\DoctorSlots;
use Src\DoctorSlots\Domain\DoctorSlotStart;

final class EloquentSlotSorter implements SlotsSorter
{
    public function sortingBySlotDuration()
    {
        $slots = DB::select("
            SELECT slots.start, slots.end, slots.doctor_id, timediff(slots.end, slots.start) as time_diff
            FROM slots
            ORDER BY time_diff DESC
        ");

        $doctorSlots = new DoctorSlots();

        foreach ($slots as $slot) {
            $doctorSlots->add(new DoctorSlot(
                new DoctorId($slot->doctor_id),
                new DoctorSlotStart(Carbon::make($slot->start)),
                new DoctorSlotEnd(Carbon::make($slot->end))
            ));
        }

        return $doctorSlots;
    }

    public function sortingBySlotDateAndTime()
    {
        $slots = DB::select("
            SELECT *
            FROM slots
            ORDER BY slots.start
        ");

        $doctorSlots = new DoctorSlots();

        foreach ($slots as $slot) {
            $doctorSlots->add(new DoctorSlot(
                new DoctorId($slot->doctor_id),
                new DoctorSlotStart(Carbon::make($slot->start)),
                new DoctorSlotEnd(Carbon::make($slot->end))
            ));
        }

        return $doctorSlots;
    }
}
