<?php

declare(strict_types=1);

namespace Tests\src\Doctor\Infrastructure\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Doctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;
use Tests\TestCase;

final class EloquentDoctorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_get_all_doctors()
    {
        $newDoctors = [
            [
                'id' => 0,
                'name' => 'Cristian'
            ],
            [
                'id' => 1,
                'name' => 'Oscar'
            ],
        ];

        $doctorList = new Doctors();

        foreach ($newDoctors as $newDoctor) {
            $doctorList->add(new Doctor(
                new DoctorId($newDoctor['id']),
                new DoctorName($newDoctor['name']),
            ));
        }

        $repository = new EloquentDoctorRepository();
        $repository->saveAll($newDoctors);

        $doctors = $repository->getAll();

        $this->assertEquals($doctorList, $doctors);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_save_all_doctors()
    {
        $doctors = [
            [
                'id' => 0,
                'name' => 'Cristian'
            ],
            [
                'id' => 1,
                'name' => 'Oscar'
            ],
        ];

        $repository = new EloquentDoctorRepository();
        $repository->saveAll($doctors);

        $doctorsSaved = \App\Models\Doctor::all()->toArray();

        $this->assertEquals($doctors, $doctorsSaved);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_save_a_doctor()
    {
        // We create the doctor
        $newDoctor = new Doctor(
            new DoctorId(30),
            new DoctorName('Cristian')
        );

        // We save the doctor
        $repository = new EloquentDoctorRepository();
        $repository->save($newDoctor);

        // We get the doctor saved
        $doctorSaved = $repository->findByCriteria($newDoctor->name());

        $this->assertEquals($newDoctor, $doctorSaved);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_search_a_doctor()
    {
        $newDoctor = new Doctor(
            new DoctorId(0),
            new DoctorName('Cristian')
        );

        // We save the doctor
        $repository = new EloquentDoctorRepository();
        $repository->save($newDoctor);

        // We search the doctor by its ID
        $doctor = $repository->search($newDoctor->id());

        $this->assertNotNull($doctor);

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_shouldnt_search_a_doctor()
    {
        $newDoctor = new Doctor(
            new DoctorId(0),
            new DoctorName('Cristian')
        );

        $repository = new EloquentDoctorRepository();
        $doctor = $repository->search($newDoctor->id());

        $this->assertNull($doctor);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_find_a_doctor_by_criteria()
    {
        $newDoctor = new Doctor(
            new DoctorId(0),
            new DoctorName('Cristian')
        );

        // We save the doctor
        $repository = new EloquentDoctorRepository();
        $repository->save($newDoctor);

        // We search the doctor by its ID
        $doctor = $repository->findByCriteria($newDoctor->name());

        $this->assertNotNull($doctor);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_shouldnt_find_a_doctor_by_criteria()
    {
        $newDoctor = new Doctor(
            new DoctorId(0),
            new DoctorName('Cristian')
        );

        // We save the doctor
        $repository = new EloquentDoctorRepository();
        $doctor = $repository->findByCriteria($newDoctor->name());

        $this->assertNull($doctor);
    }
}
