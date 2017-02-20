<?php

namespace OlympicDrive\Models\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel {
    
    protected $table = 'products';
    
    const TYPE_FRUIT = 1;
    const TYPE_VEGETABLE = 2;
    
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public function orders() {
        return $this->morphedByMany(Order::class, 'orderable');
    }
    
    public function baskets() {
        return $this->belongsToMany(Basket::class, 'baskets_products', 'product_id');
    }
    
    public function scopeActive($query, $flag) {
        return $query->where('status', $flag);
    }
    
    public function getTypeText() {
        $types = self::getTypeArray();
        
        return $types[$this->type];
    }
    
    public static function getTypeArray() {
        return [
            self::TYPE_FRUIT     => 'Fruit',
            self::TYPE_VEGETABLE => 'Légume'
        ];
    }
    
    public function getPictureAttribute($value) {
        if (is_null($value)) {
            return null;
        }
        
        return '/upload/products/' . $value;
    }
    
    public function getThumb() {
        $picture = explode('.', $this->picture);
        
        return $picture[0] . '-thumb.' . $picture[1];
    }
    
    public function getShopThumb() {
        $picture = explode('.', $this->picture);
        
        return $picture[0] . '-thumb-shop.' . $picture[1];
    }
    
    public function getTaxesIcon() {
        if ($this->taxes) {
            return 'fa fa-check fa-fw fa-2x text-success';
        } else {
            return 'fa fa-times fa-fw fa-2x text-danger';
        }
    }
    
    public function getPriceAttribute($value) {
        return number_format((float)$value, 2, '.', '');
    }
    
    public function getWeight() {
        return $this->weight.' '.$this->getUnitsText();
    }
    
    public function getAvailabilityText() {
        return $this->availability ?
            '<span class="text-success">Disponible</span>' : '<span class="text-danger">Non Disponible</span>';
    }
    
    public function getStatusText() {
        return $this->status == $this::STATUS_ACTIVE ? 'Actif' : 'Inactif';
    }
    
    public function getUnitsText() {
        if ($this->units) {
            return 'gr';
        } else {
            return 'kg';
        }
    }
    
    public static function getStatusArray() {
        return [
            self::STATUS_ACTIVE   => 'Actif',
            self::STATUS_INACTIVE => 'Inactif'
        ];
    }
    
    
}
