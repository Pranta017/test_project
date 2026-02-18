<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     protected $fillable = ['division_id','name','bn_name','description','status','url'];


    public function division()
    {
        return $this->belongsTo(Division::class);

    }


}

