<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use App\Models\Booking;

class Service extends Model

{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "rate",
        "service_category",
        "image",
    ];

    //public function booking(): BelongsTo {
    //    return $this->belongsTo(Booking::class);
   // }
}