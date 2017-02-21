<?php

namespace OlympicDrive\Models\Entities\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel {
    
    protected $table = 'orders';
    
    const STATUS_CANCEL = 0;
    const STATUS_NEW = 1;
    const STATUS_AWAITING_VALIDATION = 2;
    const STATUS_VALIDATED = 3;
    const STATUS_PAID = 4;
    const STATUS_SHIPPED = 5;
    const STATUS_AWAITING_INFORMATIONS = 6;
    const STATUS_CLOSED = 7;
    
    public function products() {
        return $this->morphedByMany(Product::class, 'orderable')->withPivot('quantity');
    }
    
    public function baskets() {
        return $this->morphedByMany(Basket::class, 'orderable')->withPivot('quantity');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function viewer() {
        return $this->belongsTo(User::class, 'viewed_by');
    }
    
    public static function getStatusArray() {
        return [
            self::STATUS_CANCEL                => 'Annulée',
            self::STATUS_NEW                   => 'Nouvelle Commande',
            self::STATUS_AWAITING_VALIDATION   => 'En attente de validation',
            self::STATUS_VALIDATED             => 'Validée',
            self::STATUS_PAID                  => 'Payée',
            self::STATUS_SHIPPED               => 'Expediée',
            self::STATUS_AWAITING_INFORMATIONS => 'En attente d\'informations',
            self::STATUS_CLOSED                => 'Terminée',
        ];
    }
    
    public function getStatusText() {
        $status = $this::getStatusArray();
        $color = $icon = '';
        
        switch ($this->status) {
            case self::STATUS_CANCEL:
                $color = 'danger';
                $icon = '<i class="fa fa-fw fa-warning"></i>';
                break;
            case self::STATUS_NEW:
                $color = 'success';
                $icon = '<i class="fa fa-fw fa-plus"></i>';
                break;
            case self::STATUS_AWAITING_VALIDATION:
                $color = 'default';
                $icon = '<i class="fa fa-fw fa-hourglass"></i>';
                break;
            case self::STATUS_VALIDATED:
                $color = 'success';
                $icon = '<i class="fa fa-fw fa-check"></i>';
                break;
            case self::STATUS_PAID:
                $color = 'success';
                $icon = '<i class="fa fa-fw fa-dollar"></i>';
                break;
            case self::STATUS_SHIPPED:
                $color = 'primary';
                $icon = '<i class="fa fa-fw fa-truck"></i>';
                break;
            case self::STATUS_AWAITING_INFORMATIONS:
                $color = 'warning';
                $icon = '<i class="fa fa-fw fa-question"></i>';
                break;
            case self::STATUS_CLOSED:
                $color = 'success';
                $icon = '<i class="fa fa-fw fa-check-circle"></i>';
                break;
        }
        
        
        return '<span class="label label-' . $color . '">' . $icon . ' ' . $status[$this->status] . '</span>';
    }
    
    public function getTotal() {
        $total = 0;
        
        foreach ($this->products as $p) {
            $total += $p->price * $p->pivot->quantity;
        }
        
        foreach ($this->baskets as $b) {
            $total += $b->price * $b->pivot->quantity;
        }
        
        return number_format((float) $total, 2, '.', '');
    }
    
    public function getViewedAtAttribute($value) {
        return new Carbon($value);
    }
    
}
