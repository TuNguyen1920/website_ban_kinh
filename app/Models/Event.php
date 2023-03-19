<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    public $timestamps = true;

    protected $fillable = ['e_name', 'e_sub_title', 'e_banner', 'e_target', 'e_link', 'e_position', 'e_status'];
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

    const POSITIONS = [
        1 => 'Vị trí 1',
        2 => 'Vị trí 2',
        3 => 'Vị trí 3',
    ];

    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'image', 'submit']);
        if ($request->image) {
            $image = upload_image('image');
            if ($image['code'] == 1) {
                $params['e_banner'] = $image['name'];
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
