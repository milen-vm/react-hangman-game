<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
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
            'title' => $this->title,
            'qualification' => $this->qualification,
            'porgram_name' => $this->program_name,
            'date_from' => $this->date_from->translatedFormat('d F Y'),
            'date_to' => $this->date_to->translatedFormat('d F Y'),
        ];
    }
}
