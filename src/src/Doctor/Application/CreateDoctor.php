<?php

declare(strict_types=1);

namespace Src\Doctor\Application;

use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorAlreadyExists;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;

final class CreateDoctor
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke(DoctorId $id, DoctorName $name)
    {
        $this->ensureDoctorDoesntExist($id);

        $doctor = Doctor::create($id, $name);

        $this->repository->save($doctor);
    }

    private function ensureDoctorDoesntExist(DoctorId $id): void {
        $existentDoctor = $this->repository->search($id);

        if(null !== $existentDoctor) {
            throw new DoctorAlreadyExists();
        }
    }
}
