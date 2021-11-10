<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Src\Doctor\Domain\DoctorId;
use Src\DoctorSlots\Domain\Contracts\DoctorSlotsRepository;
use Src\DoctorSlots\Domain\DoctorSlot;
use Src\DoctorSlots\Domain\DoctorSlotEnd;
use Src\DoctorSlots\Domain\DoctorSlotStart;

final class EloquentDoctorSlotsRepository implements DoctorSlotsRepository
{

    public function getAll()
    {
        $slots = DB::table('slots')
            ->get()
            ->toArray();

        $array = array();

        foreach ($slots as $slot) {
            array_push($array, new DoctorSlot(
                doctorId: new DoctorId($slot->doctor_id),
                start: new DoctorSlotStart(\Illuminate\Support\Carbon::make($slot->start)),
                end: new DoctorSlotEnd(\Illuminate\Support\Carbon::make($slot->end)),
            ));
        }

        return $array;
    }

    public function save($doctorId, $slot)
    {
        DB::table('slots')
            ->upsert([
                'start' => Carbon::make($slot['start']),
                'end' => Carbon::make($slot['end']),
                'doctor_id' => $doctorId,
            ], ['start', 'doctor_id']);
    }

    public function findByCriteria(DoctorSlotStart $start, DoctorId $doctorId): ?DoctorSlot
    {
        $slot = DB::table('slots')
            ->where('start', $start->value())
            ->where('doctor_id', $doctorId->value())
            ->first();

        if (is_null($slot)) return null;

        return new DoctorSlot(
            doctorId: new DoctorId($slot->doctor_id),
            start: new DoctorSlotStart($slot->start),
            end: new DoctorSlotEnd($slot->end)
        );
    }
}
