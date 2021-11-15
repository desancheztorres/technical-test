<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use App\Http\Requests\Doctors\StoreDoctorRequest;
use Src\Doctor\Application\create\DoctorCreator;
use Src\Doctor\Application\get\GetDoctorByCriteria;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class CreateDoctorController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke(StoreDoctorRequest $request)
    {
        $doctorId = (int) $request->id;
        $doctorName = $request->name;

        $createDoctorUseCase = new DoctorCreator($this->repository);
        $createDoctorUseCase(doctorId: $doctorId, doctorName: $doctorName);

        $getDoctorUseCase = new GetDoctorByCriteria($this->repository);

        return $getDoctorUseCase->__invoke($doctorName);
    }
}
