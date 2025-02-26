<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary key
    public $timestamps = false; // Jika tidak ada kolom created_at dan updated_at

    // Kolom yang bisa diisi
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan dari array atau json output
    protected $hidden = [
        'password', // Sembunyikan password saat query
    ];
}
