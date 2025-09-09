<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'price',
        'description',
        'image',
    ];

    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
