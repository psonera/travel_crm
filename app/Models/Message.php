<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function lead(){
        return $this->belongsTo(Lead::class);
    }

    public function messageType(){
        return $this->belongsTo(Messagetype::class);
    }
}
