<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan (tidak tampil di array/json).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast kolom otomatis ke tipe data tertentu.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10 ke atas mendukung otomatis hash
    ];

    /**
     * Relasi ke tabel Booking (1 User bisa punya banyak booking).
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
