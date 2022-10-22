<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Messagetype extends Model
{
    use HasFactory;

    protected $table = 'messagetypes';


    public function messages():HasMany{
        return $this->hasMany(Message::class);

    }
}
