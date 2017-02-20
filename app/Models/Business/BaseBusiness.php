<?php


namespace OlympicDrive\Models\Business;


use Carbon\Carbon;
use File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class BaseBusiness {
    protected $write;
    protected $read;
    
    public function getLastItems($nb = 10) {
        return $this->read->getLastItems($nb);
    }
    
    public function getAll() {
        return $this->read->getAll();
    }
    
    public function getById($id) {
        return $this->read->getById($id);
    }
    
    public function getEmptyObject() {
        return $this->read->getEmptyObject();
    }
    
    public function getAllCount() {
        return $this->getAll()->count();
    }
    
    public function paginate($n) {
        return $this->read->paginate($n);
    }
    
    public function delete($id) {
        $entity = $this->read->getById($id);
        if(is_null($entity)) {
            return false;
        }
        
        return $this->write->delete($entity);
    }
    
    public function getList() {
        return $this->read->getList();
    }
    
    public function uploadPicture(UploadedFile $file, $entity, $folder) {
        
        $path = public_path('/upload/'.$folder.'/');
        
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }
        
        $dt = new Carbon('now');
        $name = $dt->getTimestamp().'-'.$folder.'-'.$entity->id;
        $ext = $file->getClientOriginalExtension();
        $image = Image::make($file);
        
        $this->generateBigImage($image, $path, $name, $ext);
    
        $this->generateThumb($image, $path, $name, $ext);
        
        $this->generateThumbShop($image, $path, $name, $ext);
        
        return $name.'.'.$ext;
    }
    
    private function generateBigImage(\Intervention\Image\Image $image, $path, $name, $ext) {
        if($image->width() > 2400 || $image->height() > 2400) {
            if($image->width() > 2400) {
                $resized = $image->widen(2400, function($constraint){
                    $constraint->upsize();
                });
            }
        
            if($image->height() > 2400) {
                $resized = $image->heighten(2400, function($constraint){
                    $constraint->upsize();
                });
            }
        } else {
            $resized = $image;
        }
        $resized->save($path.$name.'.'.$ext, 25);
    }
    
    private function generateThumb(\Intervention\Image\Image $image, $path, $name, $ext) {
        if ($image->width() >= 1088 || $image->height() >= 1145) {
            if ($image->width() > $image->height()) {
                $image = $image->widen(1088, function ($constraint) {
                    $constraint->upsize();
                });
            }
        
            if ($image->height() > $image->width()) {
                $image = $image->heighten(1145, function ($constraint) {
                    $constraint->upsize();
                });
            }
            $thumbnail = $image;
        } else {
            if ($image->width() > $image->height()) {
                $image = $image->widen(760, function ($constraint) {
                    $constraint->upsize();
                });
            }
        
            if ($image->height() > $image->width()) {
                $image = $image->heighten(800, function ($constraint) {
                    $constraint->upsize();
                });
            }
        
            $thumbnail = $image->fit(760, 800, function($constraint){
                $constraint->upsize();
                $constraint->aspectRatio();
            });
        }
    
        $thumbnail->save($path . $name.'-thumb.'.$ext, 25);
    }
    
    private function generateThumbShop(\Intervention\Image\Image $image, $path, $name, $ext) {
        if ($image->width() >= 1088 || $image->height() >= 1007) {
            if ($image->width() > $image->height()) {
                $image = $image->widen(1088, function ($constraint) {
                    $constraint->upsize();
                });
            }
            
            if ($image->height() > $image->width()) {
                $image = $image->heighten(1007, function ($constraint) {
                    $constraint->upsize();
                });
            }
            
            $thumbnail = $image->fit(1088, 1007, function($constraint){
                $constraint->upsize();
                $constraint->aspectRatio();
            });
        } else {
            if ($image->width() > $image->height()) {
                $image = $image->widen(760, function ($constraint) {
                    $constraint->upsize();
                });
            }
            
            if ($image->height() > $image->width()) {
                $image = $image->heighten(704, function ($constraint) {
                    $constraint->upsize();
                });
            }
            
            $thumbnail = $image->fit(760, 704, function($constraint){
                $constraint->upsize();
                $constraint->aspectRatio();
            });
        }
        
        $thumbnail->save($path . $name.'-thumb-shop.'.$ext, 25);
    }
}