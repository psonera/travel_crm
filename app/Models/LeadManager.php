<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadManager extends Model implements HasMedia
{
    use HasFactory,Searchable,HasRoles,InteractsWithMedia,Notifiable,HasFactory,Searchable,HasPermissions;

    protected $fillable = ['name', 'email', 'phone_number','is_admin','is_manager','is_lead_manager','lead_source_id','authorize_person','password', 'status'];

    protected $searchableFields = ['*'];

    protected $guard_name = 'web';

    protected $table = 'users';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }
}
