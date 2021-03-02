<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    //
    protected $table='questions';
    protected $fillable=['question','class_id'];
    public function class(){
       return $this->belongsTo(classes::class);
    }
}
