<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Traits\HasComment;
use Modules\Main\Casts\ImageCast;
use Modules\Main\Casts\JsonCast;
use Modules\Main\Casts\SlugCast;
use Modules\Main\Enums\PublishStatusEnum;
use Modules\Main\Models\Scopes\PublishStatusScope;
use Modules\Main\Traits\Meta\HasMeta;
use Modules\Main\Traits\Seo\HasSeo;
use Modules\Main\Traits\Tag\HasTag;
use Modules\Main\Traits\Trash\HasTrash;


class Product extends Model
{
   use HasSeo,HasTag , HasTrash ,SoftDeletes , HasComment ,HasMeta;

    protected $fillable = ["category_id","title","slug","excerpt","introduction","body","chapters","featured_image","image","video","faq","order","price_offline_regular","price_offline_sell","price_online_regular","price_online_sell","price_instalment_regular","price_instalment_sell","template",'status'];

    protected $table = 'shop_products';

    protected $casts = [
        'slug' => SlugCast::class . ':posts.show',
        'featured_image' => ImageCast::class,
        'image' => ImageCast::class,
        'status' => PublishStatusEnum::class,
        'faq' => JsonCast::class,
        'chapters' => JsonCast::class,

    ];

    public function breadcrumb()
    {
        return
            [
                $this->attributes['title'] => $this->path(),
            ];
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PublishStatusScope());
    }


    public function path()
    {
        return route('shop.products.show', $this);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productAttributes()
    {
        return $this->belongsToMany(Attribute::class , 'shop_attribute_product' )->withPivot('value_id');
    }
    public function attributeValues()
    {
        return $this->hasManyThrough(
            Attribute::class,
            AttributeValueProduct::class,
            'product_id',    // Foreign key on the pivot table
            'id',            // Foreign key on the AttributeValue table
            'id',            // Local key on the Product table
            'value_id'       // Local key on the pivot table
        );
    }

    public function getValuesOfAttributes()
    {
        return $this->productAttributes->map(function ($attribute) {
            return [
                'attribute' => [
                    'title'=>$attribute->title,
                    'icon'=>$attribute->icon,
                ],
                'values' => $attribute->values->pluck('value' ,'id')->toArray()
            ];
        });

    }


    public function carts()
    {
        return $this->belongsToMany(Cart::class ,'shop_cart_products' ,'cart_id');
    }

}
