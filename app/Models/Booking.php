<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Term;
use App\Models\Service;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        "cust_id",
        "emp_id",
        "service_id",
        "term_id",
        "status",
        "start_date",
        "start_time",
        "message",
        "remarks",
        
    ];

    public function customer(): BelongsTo {
        return $this->belongsTo(User::class, "cust_id", "id" );
    }
    public function employee(): BelongsTo {
        return $this->belongsTo(User::class, "emp_id", "id" );
    }
    public function term(): BelongsTo {
        return $this->belongsTo(Term::class);
    }
    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }

}