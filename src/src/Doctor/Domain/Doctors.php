<?php

declare(strict_types=1);

namespace Src\Doctor\Domain;

final class Doctors
{
    private array $doctors;

    public function __construct(Doctor ...$doctor){
        $this->doctors = $doctor;
    }

    public function add(Doctor $doctor): void {
        $this->doctors[] = $doctor;
    }

    public function all(): array {
        return $this->doctors;
    }
}
