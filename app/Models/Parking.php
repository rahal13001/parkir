<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Parking extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the lokasiparkir that owns the Parking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lokasiparkir(): BelongsTo
    {
        return $this->belongsTo(Parkinglocation::class, 'parkinglocation_id', 'id');
    }
}
