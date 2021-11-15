<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Doctors;

final class EloquentDoctorRepository implements DoctorRepository
{
    public function getAll(): Doctors
    {
        $doctors = DB::table('doctors')
            ->get()
            ->toArray();

        $doctorList = new Doctors();

        foreach ($doctors as $doctor) {
            $doctorList->add(new Doctor(
                new DoctorId((int) $doctor->id),
                new DoctorName($doctor->name),
            ));
        }

        return $doctorList;

    }

    public function saveAll(Doctors $doctors): void
    {
        foreach ($doctors->all() as $doctor) {
            DB::table('doctors')
                ->insertOrIgnore([
                    'id' => $doctor->id()->value(),
                    'name' => $doctor->name()->value(),
                ]);
        }
    }

    public function save(Doctor $doctor): void
    {
        DB::table('doctors')
            ->upsert([
                'id' => $doctor->id()->value(),
                'name' => $doctor->name()->value()
            ], ['id']);
    }

    public function search(DoctorId $id): ?Doctor
    {
        $doctor = DB::table('doctors')
            ->find($id->value());

        if (is_null($doctor)) return null;

        return new Doctor(
            new DoctorId((int) $doctor->id),
            new DoctorName($doctor->name),
        );
    }

    public function findByCriteria(DoctorName $name): ?Doctor
    {
        $doctor = DB::table('doctors')
            ->where('name', $name->value())
            ->first();

        if (is_null($doctor)) return null;

        return new Doctor(
            new DoctorId((int) $doctor->id),
            new DoctorName($doctor->name)
        );
    }
}
