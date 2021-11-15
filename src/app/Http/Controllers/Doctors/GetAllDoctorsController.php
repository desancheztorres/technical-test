<?php

declare(strict_types=1);

namespace App\Http\Controllers\Doctors;

use App\Http\Resources\Doctor\DoctorCollection;
use Illuminate\Http\Response;

final class GetAllDoctorsController
{
    public function __construct(private \Src\Doctor\Infrastructure\GetAllDoctorsController $controller){}

    public function __invoke(): Response
    {
        $doctors = new DoctorCollection($this->controller->__invoke()->all());

        return response($doctors);
    }
}
