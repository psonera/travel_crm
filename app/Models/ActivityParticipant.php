<?php

namespace App\Models;

use App\Models\User;
use App\Models\LeadManager;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityParticipant extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['activity_id', 'user_id', 'lead_manager_id'];

    protected $searchableFields = ['*'];

    protected $table = 'activity_participants';

    public $timestamps = false;

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    // public function users(){
    //     return $this->hasMany(User::class);
    // }

    // public function leadManagers(){
    //     return $this->hasMany(LeadManager::class);
    // }
}
