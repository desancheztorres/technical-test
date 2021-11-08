<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure;

use Illuminate\Support\Facades\Http;
use Src\Doctor\Application\GetAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;
use Src\DoctorSlots\Application\save\SaveAllSlots;
use Src\DoctorSlots\Infrastructure\Repositories\EloquentDoctorSlotsRepository;

final class SaveAllDoctorSlotsController
{
    public function __construct(private EloquentDoctorSlotsRepository $repository) {}

    public function __invoke()
    {
        $url_base = "https://cryptic-cove-05648.herokuapp.com/api/";
        $repository = new EloquentDoctorRepository();
        $doctorsUserCase = new GetAllDoctors($repository);
        $doctors = $doctorsUserCase();

        foreach ($doctors->all() as $doctor) {
            $lessonsResponse = Http::withBasicAuth(env("basic_auth_username"), env("basic_auth_password"))
                ->get($url_base . 'doctors/' . $doctor->id()->value() . '/slots');

            if($lessonsResponse->status() !== 500) {
                $slots = $lessonsResponse->json();

                foreach ($slots as $slot) {
                    $saveAllDoctorsSlot = new SaveAllSlots($this->repository);
                    $saveAllDoctorsSlot(doctorId: $doctor->id()->value(), slot: $slot);
                }
            }
        }
    }
}
