<?php

declare(strict_types=1);

namespace App\Http\Controllers\Doctors;

use App\Http\Resources\Doctor\DoctorResource;

final class GetDoctorController
{
    public function __construct(private \Src\Doctor\Infrastructure\GetDoctorController $controller) {}

    public function __invoke(string $id)
    {
        $doctor = new DoctorResource($this->controller->__invoke($id));

        return response($doctor);
    }
}
