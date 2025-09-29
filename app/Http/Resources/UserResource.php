<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'position' => $this->position,
            'description' => $this->description,
            'interests' => $this->interests,
            'image' => asset('storage/' . $this->image),
            'telegram' => $this->telegram,
            'gitlab' => $this->gitlab,
            'github' => $this->github,
        ];
    }
}
