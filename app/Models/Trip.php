<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'batch_size',
        'price',
        'trip_type_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function tripType()
    {
        return $this->belongsTo(TripType::class);
    }
}
