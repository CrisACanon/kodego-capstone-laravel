<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use App\Models\User;

class Service extends Model

{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "rate",
        "image",
    ];

    //public function user(): BelongsTo {
    //    return $this->belongsTo(User::class);
   // }
}