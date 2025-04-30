<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    protected $fillable = ['name'];

    public function scopeFilter($q, array $f)
    {
        if($f['name'] ?? false)
            $q->where('name','like','%'.$f['name'].'%');
        return $q;
    }

}
