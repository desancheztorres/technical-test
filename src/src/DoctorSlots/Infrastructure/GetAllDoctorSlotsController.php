<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure;

use Illuminate\Http\Request;
use Src\DoctorSlots\Domain\Exceptions\SortTypeNotFound;
use Src\DoctorSlots\Application\sort\{SortByDateAndTime, SortBySlotDuration};
use Src\DoctorSlots\Infrastructure\Repositories\EloquentSlotSorter;

final class GetAllDoctorSlotsController
{
    public function __construct(private EloquentSlotSorter $repository){}

    public function __invoke(Request $request)
    {
        $sort_types = [
            'duration' => SortBySlotDuration::class,
            'date_and_time' => SortByDateAndTime::class
        ];

        if(!array_key_exists($request->sort_type, $sort_types)) {
            throw new SortTypeNotFound();
        }

        $newSlotOrdering = new $sort_types[$request->sort_type]($this->repository, $request->date_from, $request->date_to);

        return $newSlotOrdering();
    }
}
