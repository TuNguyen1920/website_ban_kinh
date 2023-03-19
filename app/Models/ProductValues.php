<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValues extends Model
{
    use HasFactory;
    protected $table = 'product_values';
    public $timestamps = true;
}
