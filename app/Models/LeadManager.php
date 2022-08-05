<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadManager extends Model implements HasMedia
{
    use HasFactory,Searchable,HasRoles,InteractsWithMedia;

    protected $fillable = ['name', 'email', 'contact_number', 'lead_source_id'];

    protected $searchableFields = ['*'];

    protected $guard_name = 'web';
    
    protected $table = 'lead_managers';

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
