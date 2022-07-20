<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadPipeline extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'is_default', 'rotten_days'];

    protected $searchableFields = ['*'];

    protected $table = 'lead_pipelines';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function leadStages()
    {
        return $this->hasMany(LeadStage::class);
    }
}
