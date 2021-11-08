<?php

declare(strict_types=1);

namespace Src\Doctor\Domain\Contracts;

use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Doctors;

interface DoctorRepository
{
    public function getAll(): Doctors;
    public function saveAll(array $doctors): void;
    public function save(Doctor $doctor): void;
    public function search(DoctorId $id): ?Doctor;
    public function findByCriteria(DoctorName $name): ?Doctor;
}
