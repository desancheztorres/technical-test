<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use Src\Doctor\Application\get\GetAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class GetAllDoctorsController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke()
    {
        $doctors = new GetAllDoctors($this->repository);

        return $doctors();
    }
}
