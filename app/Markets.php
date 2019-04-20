<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markets extends Model
{
    protected $fillable = ['name'];
    protected $primaryKey = 'idMarket';
}
