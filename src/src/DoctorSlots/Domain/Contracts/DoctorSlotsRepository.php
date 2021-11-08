<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Domain\Contracts;

interface DoctorSlotsRepository
{
    public function getAll();
    public function save($doctorId, $slot);
}
