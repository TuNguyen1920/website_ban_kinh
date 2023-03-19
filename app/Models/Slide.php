<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $table = 'slides';
    public $timestamps = true;

    protected $fillable = ['sd_title', 'sd_sub_title', 'sd_link', 'sd_image', 'sd_description', 'sd_target', 'sd_active', 'sd_sort'];

    const TARGET = [
        '0' => 'Không',
        '_blank' => '_blank',
        '_self' => '_self',
        '_parent' => '_parent',
        '_top' => '_top',
    ];

    const ACTIVE = [
        1 => "Hiển thị",
        0 => "Bản nháp"
    ];

    /**
     * @param $request
     * @param string $id
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'sd_image', 'submit']);
        if ($request->sd_image) {
            $image = upload_image('sd_image');
            if ($image['code'] == 1) {
                $params['sd_image'] = $image['name'];
            }
        }

        if ($id) {
            $slide = $this->find($id);
            return $slide->fill($params)->save();
        } else {
            return $this->fill($params)->save();
        }
    }
}
