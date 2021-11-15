<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use Src\Doctor\Application\get\GetDoctor;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class GetDoctorController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke(string $doctorId)
    {
        $id = (int) $doctorId;

        $doctor = new GetDoctor($this->repository);

        return $doctor($id);
    }
}
