<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;
    const TYPES = [
        1 => 'Sản phẩm',
        2 => 'Tin tức'
    ];
     const STATUS = [
         1 => 'Hiển thị',
         2 => 'Ẩn'
     ];

     const SORT_BY = [
        'id-desc' => "Mới đến cũ",
        'id-asc' => "Cũ đến mới",
        'price-desc' => "Giá từ cao đến thấp ",
        'price-asc' => "Giá từ thấp đến cao"
     ];
    const SORT_PRICE = [
        'all' => "Tất cả",
        '0-100000' => "Dưới 100.000đ",
        '100000-500000' => "100.000đ -> 500.000đ",
        '500000-1000000' => "500.000đ -> 1.000.000đ",
        '1000000-1500000' => "1.000.000đ -> 1.500.000đ",
        '2000000-2500000' => "2.000.000đ -> 2.500.000đ",
        '3000000-max' => 'Trên 3.000.000đ'
    ];

    protected $fillable = ['c_name', 'c_parent_id', 'c_slug', 'c_avatar', 'c_banner', 'c_description', 'c_hot', 'c_status', 'c_type'];

    public function products()
    {
        return $this->hasMany(Product::class, 'pro_category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'c_parent_id', 'id');
    }

    public function parent(){
        return $this->hasOne(self::class, 'id', 'c_parent_id')->select('id', 'c_name');
    }

    public function getParents()
    {
        return $this->whereNull('c_parent_id')->orderByDesc('id')->get();
    }

    public function news()
    {
        return $this->hasMany(Article::class, 'a_category_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['images', '_token']);
        if (isset($request->images) && !empty($request->images)) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['c_banner'] = $image['name'];
        }
        $params['c_slug'] = Str::slug($request->c_name);
        if ($id) {
           return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
