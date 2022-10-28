<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadProduct extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'quantity',
        'price',
        'amount',
        'lead_id',
        'product_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'lead_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
