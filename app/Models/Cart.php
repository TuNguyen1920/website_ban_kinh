<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    const VNP_URL = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    const VNP_HASH_SECRET = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
    const VNP_TMN_CODE = "Y4U88XFK";

    protected $table = 'carts';
    public $timestamps = true;

    protected $fillable = ['cr_ip_address', 'cr_status'];

    public function productCart ()
    {
        return $this->hasMany(ProductCart::class, 'pc_cart_id', 'id');
    }
}
