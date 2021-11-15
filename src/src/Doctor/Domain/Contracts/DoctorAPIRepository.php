<?php

declare(strict_types=1);

namespace Src\Doctor\Domain\Contracts;

use Src\Doctor\Domain\Doctors;

interface DoctorAPIRepository
{
    public function getAll(): ?Doctors;
}
