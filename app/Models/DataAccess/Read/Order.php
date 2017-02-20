<?php


namespace OlympicDrive\Models\DataAccess\Read;


use OlympicDrive\Models\Entities\Eloquent\Order as OrderModel;

class Order extends BaseReader {
    
    public function __construct() {
        $this->entity = new OrderModel;
    }
    
    public function paginate($nb, $status = []) {
        $orders =  OrderModel::orderBy('created_at', 'DESC');
        if(!empty($status)) {
            $orders = $orders->whereIn('status', $status);
        }
        
        return $orders->paginate($nb);
    }
    
    public function paginateFromUser($nb, $user_id) {
        $orders =  OrderModel::where('user_id', $user_id)->orderBy('created_at', 'DESC');
        return $orders->paginate($nb);
    }
    
    public function getByStatus(array $status, $nb = 10) {
        return OrderModel::whereIn('status', $status)
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();
    }
    
    public function getOrderStatus() {
        return [
            OrderModel::STATUS_CANCEL,
            OrderModel::STATUS_AWAITING_VALIDATION,
            OrderModel::STATUS_VIEWED,
            OrderModel::STATUS_VALIDATED,
            OrderModel::STATUS_PAID,
            OrderModel::STATUS_SHIPPED,
            OrderModel::STATUS_AWAITING_INFORMATIONS,
            OrderModel::STATUS_CLOSED
        ];
    }
}