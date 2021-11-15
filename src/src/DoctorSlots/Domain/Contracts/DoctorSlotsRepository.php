<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Contracts;

use Src\Doctor\Domain\DoctorId;
use Src\DoctorSlots\Domain\DoctorSlot;
use Src\DoctorSlots\Domain\DoctorSlots;
use Src\DoctorSlots\Domain\DoctorSlotStart;

interface DoctorSlotsRepository
{
    public function getAll(): ?DoctorSlots;
    public function save(DoctorId $doctorId, $slot);
    public function findByCriteria(DoctorSlotStart $start, DoctorId $doctorId): ?DoctorSlot;
}
