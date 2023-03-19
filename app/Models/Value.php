<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Value extends Model
{
    use HasFactory;
    protected $table = 'values';
    public $timestamps = true;

    protected $fillable = ['v_name', 'v_slug', 'v_attribute_id'];

    public function attribute ()
    {
        return $this->belongsTo(Attribute::class, 'v_attribute_id', 'id');
    }

    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token']);

        $params['v_slug'] = Str::slug($request->a_name);
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
