<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function board(){
        return $this->belongsTo(Board::class);
    }
}
