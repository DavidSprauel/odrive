<?php


namespace OlympicDrive\Models\DataAccess\Write;


use Carbon\Carbon;
use OlympicDrive\Models\Entities\Eloquent\Order as OrderModel;

class Order extends BaseWriter {
    
    public function __construct() {
        $this->entity = new OrderModel();
    }
    
    public function setViewed($order_id, $user_id) {
        return true;
        /*$order = OrderModel::find($order_id);
        $order->viewed_by = $user_id;
        $order->viewed_at = new Carbon('now');
        
        if($order->status == OrderModel::STATUS_NEW) {
            $order->status = OrderModel::STATUS_AWAITING_VALIDATION;
        }
        
        return $order->save();*/
    }
}