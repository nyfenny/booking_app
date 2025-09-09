<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemesan',
        'nomor_hp',
        'room_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
