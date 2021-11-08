<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Application\get;

use Src\DoctorSlots\Domain\Contracts\DoctorSlotsRepository;

final class GetAllDoctorSlots
{
    public function __construct(private DoctorSlotsRepository $repository) {}

    public function __invoke()
    {
        return $this->repository->getAll();
    }
}
