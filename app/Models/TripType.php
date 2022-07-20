<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'trip_types';

    public $timestamps = false;

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
