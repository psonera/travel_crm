<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadStage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'is_user_defined',
        'lead_pipeline_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'lead_stages';

    public function leadPipeline()
    {
        return $this->belongsTo(LeadPipeline::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'lead_pipeline_stage_id');
    }
}
