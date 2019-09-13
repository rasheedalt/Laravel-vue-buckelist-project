<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function bucketlist(){
        return $this->belongsTo('App\Bucketlist');
    }
}
