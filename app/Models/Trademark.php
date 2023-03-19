<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    use HasFactory;
    protected $table = 'trademarks';
    public $timestamps = true;

    protected $fillable = ['td_name', 'td_image', 'td_link', 'td_description', 'td_email', 'td_phone', 'td_address', 'td_fax'];

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['td_image', '_token']);
        if (isset($request->images) && !empty($request->images)) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['td_image'] = $image['name'];
        }
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
