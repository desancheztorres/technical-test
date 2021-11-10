<?php

declare(strict_types=1);

namespace Src\Doctor\Application\get;

use Src\Doctor\Domain\Contracts\DoctorRepository;

final class GetAllDoctors
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke()
    {
        return $this->repository->getAll();
    }
}
