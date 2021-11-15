<?php

declare(strict_types=1);

namespace Src\Doctor\Domain;

final class Doctor
{
    public function __construct(private DoctorId $id, private DoctorName $name) {}

    public function id(): DoctorId
    {
        return $this->id;
    }

    public function name(): DoctorName
    {
        return $this->name;
    }

    public static function create(
        DoctorId   $id,
        DoctorName $name,
    ): Doctor
    {
        return new self($id, $name);
    }
}
