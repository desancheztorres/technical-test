<?php

declare(strict_types=1);

namespace Src\Doctor\Application\get;

use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\DoctorName;

final class GetDoctorByCriteria
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke(string $doctorName)
    {
        $name = new DoctorName($doctorName);

        return $this->repository->findByCriteria($name);
    }
}
