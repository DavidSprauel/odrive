<?php


namespace OlympicDrive\Models\DataAccess\Read;


abstract class BaseReader {
    protected $entity = '';
    
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public function __construct($entity) {
        $this->entity = $entity;
    }
    
    public function getLastItems($nb) {
        $model = $this->entity;
        if($nb == 1) {
            return $model::orderBy('created_at', 'DESC')->take($nb)->first();
        }
        return $model::orderBy('created_at', 'DESC')->take($nb)->get();
    }
    
    public function paginate($n, $status = [self::STATUS_ACTIVE, self::STATUS_INACTIVE]) {
        $model = $this->entity;
        return $model::whereIn('status', $status)->paginate($n);
    }
    
    public function getAll() {
        $model = $this->entity;
        return $model::all();
    }
    
    public function getById($id) {
        $model = $this->entity;
        return $model::findOrFail($id);
    }
    
    public function getEmptyObject() {
        $model = $this->entity;
        return new $model;
    }
    
    public function exists($field, $value) {
        $model = $this->entity;
        return $model::where($field, $value)->first();
    }
}