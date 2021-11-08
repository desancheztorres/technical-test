<?php

declare(strict_types=1);

namespace App\Http\Controllers\DoctorSlots;

final class SaveAllDoctorSlotsController
{
    public function __construct(private \Src\DoctorSlots\Infrastructure\SaveAllDoctorSlotsController $controller) {}

    public function __invoke()
    {
        $this->controller->__invoke();

        return response(null, 201);
    }
}
