<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucketlist extends Model
{
    public function items(){
        return $this->hasMany('App\Item');
    }
}
