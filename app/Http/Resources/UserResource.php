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
            "id" => $this->id,
            "user" => [
                "full_name" => $this->first_name . " " . $this->last_name
            ],
            "user_role" => $this->user_role,
            "email" => $this->email,
            "id_proof" => $this->id_proof,
        ];
    }
}

