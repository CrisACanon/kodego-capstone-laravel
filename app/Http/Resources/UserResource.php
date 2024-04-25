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
     
            "fullname" => $this->first_name . " " . $this->last_name,
            "detailed_address" => $this->detailed_address . ", " . $this->city_municipality,
            "province" => $this->province,
            "contact_number" => $this->contact_number,
            "email" => $this->email,
            "user_role" => $this->user_role,
            "id_proof" => $this->id_proof,
        ];
    }
}

