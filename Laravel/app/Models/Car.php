<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand','model','year','price_per_day','car_category_id'];
    public function scopeFilter($q, array $f)
    {
        if($f['brand']   ?? false) $q->where('brand','like','%'.$f['brand'].'%');
        if($f['model']   ?? false) $q->where('model','like','%'.$f['model'].'%');
        if($f['year']    ?? false) $q->where('year',$f['year']);
        if($f['car_category_id'] ?? false)
            $q->where('car_category_id',$f['car_category_id']);
        return $q;
    }



}
