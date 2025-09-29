<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'short_description' => $this->short_description,
            'date_from' => $this->date_from->translatedFormat('d F Y'),
            'date_to' => $this->date_to->translatedFormat('d F Y'),
            'company_name' => $this->company_name,
            'technologies' => TechnologyResource::collection($this->technologies),
        ];
    }
}
