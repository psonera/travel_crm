<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasPermissions;
    use HasApiTokens;
    use InteractsWithMedia;

    protected $fillable = ['name', 'email', 'phone_number','is_admin','is_manager','is_lead_manager','lead_source_id','authorize_person','password', 'status'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // public function activityParticipants(){
    //     return $this->belongsToMany(ActivityParticipant::class);
    // }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function email(){
        return $this->hasMany(Email::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
