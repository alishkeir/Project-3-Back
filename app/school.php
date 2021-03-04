<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    protected $table='schools';
    protected $fillable=['name','students_no'];
}
