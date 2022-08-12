<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'content'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'notes';

}
