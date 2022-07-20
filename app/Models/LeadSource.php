<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadSource extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'lead_sources';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function leadManagers()
    {
        return $this->hasMany(LeadManager::class);
    }
}
