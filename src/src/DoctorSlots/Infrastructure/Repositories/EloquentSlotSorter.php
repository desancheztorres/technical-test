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
    public function sortingBySlotDuration(string $date_from, string $date_to): ?DoctorSlots
    {
        $from = Carbon::make($date_from)->toDateString();
        $to = Carbon::make($date_to)->toDateString();

        $slots = DB::select('
            SELECT s.start, s.end, s.doctor_id, timediff(s.end, s.start) as time_diff, CAST(s.start as DATE) as d
            FROM slots s
            WHERE cast(s.start as date) BETWEEN ? AND ?
            ORDER BY time_diff DESC
        ', [$from, $to]);

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

    public function sortingBySlotDateAndTime(string $date_from, string $date_to): ?DoctorSlots
    {
        $from = Carbon::make($date_from)->toDateString();
        $to = Carbon::make($date_to)->toDateString();

        $slots = DB::select('
            SELECT s.*
            FROM slots s
            WHERE cast(s.start as date) BETWEEN ? AND ?
            ORDER BY s.start
        ', [$from, $to]);

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
