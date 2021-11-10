<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure;

use Illuminate\Support\Facades\Http;
use Src\Doctor\Application\get\GetAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;
use Src\DoctorSlots\Application\save\SaveAllSlots;
use Src\DoctorSlots\Infrastructure\Repositories\EloquentDoctorSlotsRepository;

final class SaveAllDoctorSlotsController
{
    public function __construct(
        private EloquentDoctorRepository $doctorRepository,
        private EloquentDoctorSlotsRepository $doctorSlotsRepository,
    ) {}

    public function __invoke()
    {
        $doctorsUserCase = new GetAllDoctors($this->doctorRepository);
        $doctors = $doctorsUserCase();

        foreach ($doctors->all() as $doctor) {
            $slotsResponse = Http::withBasicAuth(config("app.basic_auth_username"), config("app.basic_auth_password"))
                ->get(config('app.api_url_base') . '/doctors/' . $doctor->id()->value() . '/slots');

            if($slotsResponse->status() !== 500) {
                $slots = $slotsResponse->json();

                foreach ($slots as $slot) {
                    $saveAllDoctorsSlot = new SaveAllSlots($this->doctorSlotsRepository);
                    $saveAllDoctorsSlot(doctorId: $doctor->id()->value(), slot: $slot);
                }
            }
        }
    }
}
