<?php

declare(strict_types=1);

namespace Src\DoctorSlots\Infrastructure;

use App\Http\Requests\DoctorSlots\GetDoctorSlotsRequest;
use Src\Shared\Domain\Enums\SortTypes;
use Src\DoctorSlots\Infrastructure\Repositories\EloquentSlotSorter;

final class GetAllDoctorSlotsController
{
    public function __construct(private EloquentSlotSorter $repository){}

    public function __invoke(GetDoctorSlotsRequest $request)
    {
        $sort = SortTypes::SORT_TYPES[$request->sort_type];

        $newSlotOrdering = new $sort($this->repository, $request->date_from, $request->date_to);

        return $newSlotOrdering();
    }
}
