<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gender',
    ];

    protected $primaryKey = 'id_pelanggan';

    // Nonaktifkan timestamps
    public $timestamps = false;

    protected $table = 'pelanggan';
}