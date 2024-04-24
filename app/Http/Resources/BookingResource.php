<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\TermResource;
//use App\Http\Resources\ServiceResource;


class BookingResource extends JsonResource
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
            "cust_id" => $this->cust_id,
            "customer" => $this->customer,
            "emp_id"=> $this->emp_id,
            "employee" => $this->employee,    
            "service_id" => $this->service_id,
            "service_title" => $this->service->title,
            "description" => $this->service->description,
            "term_id" => $this->term_id,
            "term_title" => $this->term->title,
            "remarks" => $this->remarks,
            "message" => $this->message,
            "start_date" => $this->start_date,
            "start_time" => $this->start_time,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}