<?php

namespace App\Http\Resources\DoctorSlots;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorSlotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'start' => $this->start()->value(),
                'end' => $this->end()->value(),
                'doctor_id' => $this->doctorId()->value(),
            ],
            'links' => [
                'self' => url('/slots/' . $this->doctorId()->value()),
            ]
        ];
    }
}
