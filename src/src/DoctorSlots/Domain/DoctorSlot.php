<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain;

use Src\Doctor\Domain\DoctorId;
use Src\Shared\Domain\AggregateRoot;

final class DoctorSlot extends AggregateRoot
{
    public function __construct(
        private DoctorId $doctorId,
        private DoctorSlotStart $start,
        private DoctorSlotEnd $end,
    ){}

    public function doctorId(): DoctorId {
        return $this->doctorId;
    }

    public function start(): DoctorSlotStart {
        return $this->start;
    }

    public function end(): DoctorSlotEnd {
        return $this->end;
    }

    public static function create(
        DoctorId $id,
        DoctorSlotStart $start,
        DoctorSlotEnd $end
    ): DoctorSlot {
        return new self($id, $start, $end);
    }
}
