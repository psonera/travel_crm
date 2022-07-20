<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['sku', 'name', 'description', 'quantity', 'price'];

    protected $searchableFields = ['*'];

    public function leadProducts()
    {
        return $this->hasMany(LeadProduct::class);
    }
}
