<?php

namespace App\Models;

use App\Models\Lead;
use App\Models\User;
use App\Models\Activity;
use App\Models\Scopes\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityFile extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'activity_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
