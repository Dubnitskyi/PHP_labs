<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['rental_id','amount','paid_at','method'];

    public function scopeFilter($q, array $f)
    {
        if($f['amount']    ?? false) $q->where('amount',$f['amount']);
        if($f['paid_at']   ?? false) $q->where('paid_at',$f['paid_at']);
        if($f['method']    ?? false) $q->where('method','like','%'.$f['method'].'%');
        if($f['rental_id'] ?? false) $q->where('rental_id',$f['rental_id']);
        return $q;
    }

}
