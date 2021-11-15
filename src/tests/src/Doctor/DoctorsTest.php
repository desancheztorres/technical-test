<?php

namespace Tests\src\Doctor;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Prophecy\PhpUnit\ProphecyTrait;
use Src\Doctor\Domain\Contracts\DoctorRepository;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Domain\Doctors;
use Tests\TestCase;

class DoctorsTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, ProphecyTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = DoctorRepository::class;
        $this->doctors = new Doctors(
            new Doctor(
                new DoctorId(0),
                new DoctorName('Cristian'),
            ),
            new Doctor(
                new DoctorId(1),
                new DoctorName('Oscar'),
            ),
        );
    }

    public function test_it_should_get_all_doctors()
    {
        $doctorRepository = $this->prophesize($this->repository);
        $doctorRepository
            ->getAll()
            ->shouldBeCalled()
            ->willReturn($this->doctors);

        $response = $doctorRepository->reveal()->getAll();

        $this->assertEquals($this->doctors, $response);
    }

    public function test_it_should_save_all_doctors()
    {
        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->saveAll($this->doctors)
            ->shouldBeCalled();

        $doctorRepository->reveal()->saveAll($this->doctors);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_save_a_doctor()
    {
        $doctor = new Doctor(
            new DoctorId(30),
            new DoctorName('Cristian')
        );

        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->save($doctor)
            ->shouldBeCalled();

        $doctorRepository->reveal()->save($doctor);
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

        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->search($newDoctor->id())
            ->shouldBeCalled()
            ->willReturn($newDoctor);

        $doctor = $doctorRepository->reveal()->search($newDoctor->id());

        $this->assertEquals($newDoctor, $doctor);

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

        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->search($newDoctor->id())
            ->shouldBeCalled()
            ->willReturn();

        $doctor = $doctorRepository->reveal()->search($newDoctor->id());

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

        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->findByCriteria($newDoctor->name())
            ->shouldBeCalled()
            ->willReturn($newDoctor);

        $doctor = $doctorRepository->reveal()->findByCriteria($newDoctor->name());

        $this->assertNotNull($doctor);
        $this->assertEquals($newDoctor, $doctor);
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

        $doctorRepository = $this->prophesize(DoctorRepository::class);
        $doctorRepository
            ->findByCriteria($newDoctor->name())
            ->shouldBeCalled()
            ->willReturn();

        $doctor = $doctorRepository->reveal()->findByCriteria($newDoctor->name());

        $this->assertNull($doctor);
    }
}
