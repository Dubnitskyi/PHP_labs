<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ['car_id','client_id','rent_from','rent_to'];

    public function scopeFilter($q, array $f)
    {
        if($f['rent_from'] ?? false) $q->where('rent_from','>=',$f['rent_from']);
        if($f['rent_to']   ?? false) $q->where('rent_to','<=',$f['rent_to']);
        if($f['car_id']    ?? false) $q->where('car_id',$f['car_id']);
        if($f['client_id'] ?? false) $q->where('client_id',$f['client_id']);
        return $q;
    }

}
