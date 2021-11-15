<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure\Repositories;

use Illuminate\Support\Facades\Http;
use Src\Doctor\Domain\Contracts\DoctorAPIRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Doctors;

final class InMemoryDoctorAPIRepository implements DoctorAPIRepository
{
    public function getAll(): ?Doctors
    {
        $doctors = Http::withBasicAuth(config('app.basic_auth_username'), config("app.basic_auth_password"))
            ->get(config('app.api_url_base') . '/doctors')
            ->json();

        $doctorList = new Doctors();

        foreach ($doctors as $doctor) {
            $doctorList->add(new Doctor(
                new DoctorId((int) $doctor['id']),
                new DoctorName($doctor['name']),
            ));
        }

        return $doctorList;
    }
}
