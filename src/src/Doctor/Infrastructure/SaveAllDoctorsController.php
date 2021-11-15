<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use Src\Doctor\Application\get\GetDoctorsAPI;
use Src\Doctor\Application\save\SaveAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;
use Src\Doctor\Infrastructure\Repositories\InMemoryDoctorAPIRepository;

final class SaveAllDoctorsController
{
    public function __construct(
        private EloquentDoctorRepository $doctorRepository,
        private InMemoryDoctorAPIRepository $doctorAPIRepository
    ) {}

    public function __invoke()
    {
        $doctors = new GetDoctorsAPI($this->doctorAPIRepository);
        $saveAllDoctors = new SaveAllDoctors($this->doctorRepository);

        $saveAllDoctors($doctors());
    }
}
