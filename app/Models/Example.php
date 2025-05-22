<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasFactory;
    protected $table = 'example';
    protected $fillable = [
        'data_string',
        'data_int',
        'data_text',
        'date',
    ];
}
