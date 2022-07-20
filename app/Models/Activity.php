<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'type',
        'comment',
        'schedule_from',
        'schedule_to',
        'is_done',
        'user_id',
        'location',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'schedule_from' => 'datetime',
        'schedule_to' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityParticipants()
    {
        return $this->hasMany(ActivityParticipant::class);
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
