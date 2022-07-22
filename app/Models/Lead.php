<?php

namespace App\Models;

use App\Models\LeadPipelineStage;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'lead_value',
        'status',
        'traveler_count',
        'selected_trip_date',
        'user_id',
        'lead_manager_id',
        'lead_source_id',
        'lead_type_id',
        'lead_pipeline_id',
        'lead_pipeline_stage_id',
        'trip_id',
        'trip_type_id',
        'accomodation_id',
        'transport_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'selected_trip_date' => 'date',
        'closed_at' => 'datetime',
        'expected_closed_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leadManager()
    {
        return $this->belongsTo(LeadManager::class);
    }

    public function leadType()
    {
        return $this->belongsTo(LeadType::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function leadPipeline()
    {
        return $this->belongsTo(LeadPipeline::class);
    }

    public function leadPipelineStage()
    {
        return $this->belongsTo(
            LeadPipelineStage::class,
            'lead_pipeline_stage_id'
        );
    }

    public function leadProducts()
    {
        return $this->hasMany(LeadProduct::class);
    }

    public function leadStage()
    {
        return $this->belongsTo(LeadStage::class, 'lead_pipeline_stage_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function tripType()
    {
        return $this->belongsTo(TripType::class);
    }

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
