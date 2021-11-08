<?php

declare(strict_types=1);

namespace Src\Doctor\Infrastructure;

use Illuminate\Support\Facades\Http;
use Src\Doctor\Application\SaveAllDoctors;
use Src\Doctor\Infrastructure\Repositories\EloquentDoctorRepository;

final class SaveAllDoctorsController
{
    public function __construct(private EloquentDoctorRepository $repository) {}

    public function __invoke()
    {
        $url_base = "https://cryptic-cove-05648.herokuapp.com/api/";

        $doctors = Http::withBasicAuth(env("basic_auth_username"), env("basic_auth_password"))
            ->get($url_base . 'doctors')
            ->json();

        $saveAllDoctors = new SaveAllDoctors($this->repository);
        $saveAllDoctors($doctors);
    }
}
