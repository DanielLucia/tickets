<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TicketsContent;

class Tickets extends Model
{
    protected $fillable = ['name', 'date', 'market'];
    protected $appends = ['total'];
    protected $primaryKey = 'idTicket';

    public function getTotalAttribute()
    {
        $content = TicketsContent::where(['ticket'=> $this->attributes['idTicket']])->get();
        $total = 0;
        foreach ($content as $element) {
            $total += (floatval($element->price) * intval($element->quantity));
        }

        return $total;
    }
}
