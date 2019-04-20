<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsContent extends Model
{
    protected $table = 'tickets_content';
    protected $fillable = ['ticket', 'product', 'quantity', 'price', 'expiry'];
    protected $primaryKey = 'idContent';
}
