<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\classes;
class classes extends Model
{
    //
    protected $table='classes';
    protected $fillable=['name'];
    public function question(){
        return $this->hasMany(question::class,'class_id');
    }
    

}
