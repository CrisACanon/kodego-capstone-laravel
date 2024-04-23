<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        "cust_id",
        "service_id",
        "term_id",
        "status",
        "start_date",
        "start_time",
        "message",
        "remarks",
        "emp_id",
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}