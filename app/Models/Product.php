<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProductValues;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    const TYPES = [
        1 => 'Best seller',
        2 => 'Pre order',
        3 => 'New arrival',
        4 => 'Sold out',
        5 => 'Limited',
        6 => 'Last chance',
        7 => 'Women',
        8 => 'Man',
        9 => 'Out of stock',
    ];
    protected $fillable = [
        'pro_name',
        'pro_slug',
        'pro_price',
        'pro_price_entry',
        'pro_sale',
        'pro_is_sale',
        'pro_avatar',
        'pro_view',
        'pro_hot',
        'pro_active',
        'pro_pay',
        'pro_description',
        'pro_content',
        'pro_specifications',
        'pro_review_total',
        'pro_review_star',
        'pro_keywords',
        'pro_number',
        'pro_category_id',
        'pro_user_id',
        'pro_trademark_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'pro_category_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Value::class, 'product_values','pv_product_id', 'pv_value_id');
    }

    public function trademark()
    {
        return $this->belongsTo(Trademark::class, 'pro_trademark_id', 'id');
    }
    public function types()
    {
        return $this->belongsToMany(Type::class, 'product_types','product_id', 'type_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'pi_product_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'values', 'images', 'files', 'types', 'pv_price']);
        $prices = $request->pv_price;

        $params['pro_slug'] = Str::slug($request->pro_name);

        if ($request->images) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['pro_avatar'] = $image['name'];
        }

        if ($id) {
            $product = $this->find($id);
            $product->attributes()->detach();
            $product->types()->detach();
            $product->attributes()->attach($request->values);
            $product->types()->attach($request->types);

            foreach ($prices as $key => $price) {
                $productValues = ProductValues::where(['pv_product_id' => $product->id, 'pv_value_id' => $key])->first();
                if ($productValues) {
                    $productValues->pv_price = $price;
                    $productValues->save();
                }
            }

            return $product->fill($params)->save();
        } else {
            $this->fill($params)->save();
            $this->attributes()->attach($request->values);

            foreach ($prices as $key => $price) {
                $productValues = ProductValues::where(['pv_product_id' => $this->id, 'pv_value_id' => $key])->first();
                if ($productValues) {
                    $productValues->pv_price = $price;
                    $productValues->save();
                }
            }
            return $this->types()->attach($request->types);
        }
    }
}
