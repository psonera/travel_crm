<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadPiplelineStage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'probability',
        'sort_order',
        'lead_pipeline_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'lead_pipleline_stages';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
