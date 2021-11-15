<?php

declare(strict_types=1);

namespace Src\Doctor\Application\get;

use Src\Doctor\Domain\Contracts\DoctorAPIRepository;

final class GetDoctorsAPI
{
    public function __construct(private DoctorAPIRepository $repository) {}

    public function __invoke()
    {
        return $this->repository->getAll();
    }
}
