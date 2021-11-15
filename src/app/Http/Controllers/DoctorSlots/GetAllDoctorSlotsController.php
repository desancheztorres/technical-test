<?php

declare(strict_types=1);

namespace App\Http\Controllers\DoctorSlots;

use App\Http\Requests\DoctorSlots\GetDoctorSlotsRequest;
use App\Http\Resources\DoctorSlots\DoctorSlotCollection;

final class GetAllDoctorSlotsController
{
    public function __construct(private \Src\DoctorSlots\Infrastructure\GetAllDoctorSlotsController $controller) {}

    public function __invoke(GetDoctorSlotsRequest $request)
    {
        $slots = new DoctorSlotCollection($this->controller->__invoke($request)->all());

        return response($slots);
    }
}
