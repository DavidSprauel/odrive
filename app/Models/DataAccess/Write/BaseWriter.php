<?php


namespace OlympicDrive\Models\DataAccess\Write;


use OlympicDrive\Models\Entities\Eloquent\Basket;

abstract class BaseWriter {
    
    protected $entity = '';
    
    public function __construct($entity) {
        $this->entity = $entity;
    }
    
    public function create(Array $data) {
        $model = $this->entity;
        
        if ($model::insert($data)) {
            return true;
        }
        
        return false;
    }
    
    public function save($model) {
        if($model->save()) {
            return $model;
        }
        return null;
    }
    
    public function delete($entity) {
        if($entity instanceof $this->entity) {
            if($entity instanceof Basket) {
                $entity->products()->detach();
            }
            
            if($entity->delete()) {
                return true;
            }
        }
        return false;
    }
}