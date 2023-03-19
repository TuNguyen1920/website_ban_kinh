<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $timestamps = true;

    protected $fillable = ['tst_user_id', 'tst_total_money', 'tst_name', 'tst_email', 'tst_phone', 'tst_address', 'tst_note', 'tst_status', 'tst_type', 'tr_city_id', 'tr_district_id', 'tr_street_id', 'tr_payment_methods'];

    public function city()
    {
        return $this->belongsTo(Locations::class, 'tr_city_id');
    }

    public function district()
    {
        return $this->belongsTo(Locations::class, 'tr_district_id');
    }

    public function street()
    {
        return $this->belongsTo(Locations::class, 'tr_street_id');
    }

    public function order()
    {
        return $this->hasMany(ProductCart::class,'pc_transaction_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'tst_user_id');
    }

    const STATUS = [
        1 => 'Tiếp nhận',
        2 => 'Đang giao hàng',
        3 => 'Đã giao hàng',
        4 => 'Đã hủy'
    ];

    const CLASS_STATUS = [
        1 => 'btn-secondary',
        2 => 'btn-info',
        3 => 'btn-success',
        4 => 'btn-danger'
    ];
}
