<?php

declare(strict_types=1);

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctors\StoreDoctorRequest;
use App\Http\Resources\Doctor\DoctorResource;
use Illuminate\Http\Response;

class CreateDoctorController extends Controller
{
    public function __construct(private \Src\Doctor\Infrastructure\CreateDoctorController $controller) {}

    public function __invoke(StoreDoctorRequest $request): Response
    {
        $newDoctor = new DoctorResource($this->controller->__invoke($request));

        return response($newDoctor, 201);
    }
}
