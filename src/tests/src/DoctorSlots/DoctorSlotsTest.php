<?php

declare(strict_types=1);

namespace Tests\src\DoctorSlots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Src\Doctor\Domain\Doctor;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\DoctorSlots\Domain\DoctorSlotStart;
use Src\DoctorSlots\Infrastructure\Repositories\EloquentDoctorSlotsRepository;
use Tests\TestCase;

final class DoctorSlotsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_save_slots()
    {
       $doctor = new Doctor(
           id: new DoctorId(0),
           name: new DoctorName('Cristian')
       );

       $newSlot = [
           'start' => Carbon::now(),
           'end' => Carbon::now()->addHours(2),
       ];

       $repository = new EloquentDoctorSlotsRepository();
       $repository->save($doctor->id(), $newSlot);

       $slot = $repository->findByCriteria(
         start: new DoctorSlotStart($newSlot['start']),
         doctorId: $doctor->id(),
       );

        $this->assertNotNull($slot);
    }
}
