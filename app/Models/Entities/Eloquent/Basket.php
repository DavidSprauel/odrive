<?php

namespace OlympicDrive\Models\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Basket extends BaseModel
{
    protected $table = "baskets";
    
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    
    public function products() {
        return $this->belongsToMany(Product::class, 'baskets_products', 'basket_id')->withPivot('quantity');
    }
    
    public function orders() {
        return $this->morphedByMany(Order::class, 'orderable');
    }
    
    public static function getStatusArray() {
        return [
            self::STATUS_ACTIVE => 'Actif',
            self::STATUS_INACTIVE => 'Inactif',
        ];
    }
    
    public function getPictureAttribute($value) {
        if (is_null($value)) {
            return null;
        }
        return '/upload/baskets/' . $value;
    }
    
    public function getThumb() {
        $picture = explode('.', $this->picture);
        
        return $picture[0] . '-thumb.' . $picture[1];
    }
    
    public function getShopThumb() {
        $picture = explode('.', $this->picture);
        
        return $picture[0] . '-thumb-shop.' . $picture[1];
    }
}
