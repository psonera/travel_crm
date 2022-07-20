<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadManager extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'contact_number', 'lead_source_id'];

    protected $searchableFields = ['*'];

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
