<?php

declare(strict_types=1);

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\DoctorCollection;
use Illuminate\Http\Response;

class SaveAllDoctorsController extends Controller
{
    public function __construct(private \Src\Doctor\Infrastructure\SaveAllDoctorsController $controller) {}

    public function __invoke(): Response
    {
        $doctors = new DoctorCollection($this->controller->__invoke());

        return response($doctors, 200);
    }
}
