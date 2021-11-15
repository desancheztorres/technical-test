<?php

declare(strict_types=1);

namespace Src\Doctor\Application\create;

use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Exceptions\DoctorAlreadyExists;

final class DoctorCreator
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke(int $doctorId, string $doctorName)
    {
        $id = new DoctorId($doctorId);
        $name = new DoctorName($doctorName);

        $this->ensureDoctorDoesntExist($id);

        $doctor = Doctor::create($id, $name);

        $this->repository->save($doctor);
    }

    private function ensureDoctorDoesntExist(DoctorId $id): void
    {
        $existentDoctor = $this->repository->search($id);

        if (null !== $existentDoctor) {
            throw new DoctorAlreadyExists();
        }
    }
}
