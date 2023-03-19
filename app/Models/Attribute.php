<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    public $timestamps = true;

    protected $fillable = ['a_name', 'a_slug'];

    public function values()
    {
        return $this->hasMany(Value::class, 'v_attribute_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token']);

        $params['a_slug'] = Str::slug($request->a_name);
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
