<?php

declare(strict_types=1);

namespace Src\Doctor\Application\get;

use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\Exceptions\DoctorNotFound;

final class GetDoctor
{
    public function __construct(private DoctorRepository $repository) {}

    public function __invoke(int $doctorId): ?Doctor
    {
        $id = new DoctorId($doctorId);

        $doctor = $this->repository->search($id);

        $this->guard($id, $doctor);

        return $doctor;
    }

    private function guard(DoctorId $id, Doctor $doctor = null):void {
        if(is_null($doctor)) throw new DoctorNotFound();
    }
}
