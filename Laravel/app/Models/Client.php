<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['full_name','phone','email'];

    public function scopeFilter($q, array $f)
    {
        if($f['full_name'] ?? false) $q->where('full_name','like','%'.$f['full_name'].'%');
        if($f['phone']     ?? false) $q->where('phone','like','%'.$f['phone'].'%');
        if($f['email']     ?? false) $q->where('email','like','%'.$f['email'].'%');
        return $q;
    }

}
