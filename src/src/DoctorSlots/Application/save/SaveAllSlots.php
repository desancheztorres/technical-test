<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Application\save;

use Src\DoctorSlots\Domain\Contracts\DoctorSlotsRepository;

final class SaveAllSlots
{
    public function __construct(private DoctorSlotsRepository $repository) {}

    public function __invoke($doctorId, $slot) {
        $this->repository->save($doctorId, $slot);
    }
}
