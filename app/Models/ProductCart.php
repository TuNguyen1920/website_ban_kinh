<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    protected $table = 'product_carts';
    public $timestamps = true;

    protected $fillable = ['pc_cart_id', 'pc_product_id', 'pc_transaction_id', 'pc_name', 'pc_price', 'pc_qty', 'pc_sale', 'options', 'pc_status', 'pc_color', 'pc_size'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'pc_product_id');
    }
}
