<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use App\Http\Requests\Doctors\StoreDoctorRequest;
use Src\Doctor\Application\CreateDoctor;
use Src\Doctor\Application\GetDoctorByCriteria;
use Src\Doctor\Domain\DoctorId;
use Src\Doctor\Domain\DoctorName;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class CreateDoctorController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke(StoreDoctorRequest $request)
    {
        $doctorId = (int) $request->id;
        $doctorName = $request->name;

        $createDoctorUseCase = new CreateDoctor($this->repository);
        $createDoctorUseCase(id: new DoctorId($doctorId), name: new DoctorName($doctorName));

        $getDoctorUseCase = new GetDoctorByCriteria($this->repository);

        return $getDoctorUseCase->__invoke($doctorName);
    }
}
