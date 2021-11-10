<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use Illuminate\Support\Facades\Http;
use Src\Doctor\Application\save\SaveAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class SaveAllDoctorsController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke()
    {
        $doctors = Http::withBasicAuth(config('app.basic_auth_username'), config("app.basic_auth_password"))
            ->get(config('app.api_url_base') . '/doctors')
            ->json();

        $saveAllDoctors = new SaveAllDoctors($this->repository);
        $saveAllDoctors($doctors);
    }
}
