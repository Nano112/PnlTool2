<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axes extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cusip', 'size', 'type', 'dealer', 'dealer_code'];
}
