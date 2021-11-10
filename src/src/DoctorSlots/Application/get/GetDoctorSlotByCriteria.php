<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Application\get;


use Src\Doctor\Domain\DoctorId;
use Src\DoctorSlots\Domain\Contracts\DoctorSlotsRepository;
use Src\DoctorSlots\Domain\DoctorSlotStart;
use DateTime;


final class GetDoctorSlotByCriteria
{
    public function __construct(private DoctorSlotsRepository $repository) {}

    public function __invoke(DateTime $start, int $doctorId)
    {
        $start = new DoctorSlotStart($start);
        $doctorId = new DoctorId($doctorId);

        return $this->repository->findByCriteria($start, $doctorId);
    }
}
