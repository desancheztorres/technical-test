<?php

declare(strict_types=1);

namespace Src\Doctor\Application;

use Src\Doctor\Domain\Contracts\DoctorRepository;

final class SaveAllDoctors
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke($doctors)
    {
        $this->repository->saveAll($doctors);
    }

}
