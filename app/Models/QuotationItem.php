<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuotationItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sku',
        'name',
        'quantity',
        'price',
        'coupon_code',
        'discount_percent',
        'discount_amount',
        'tax_percent',
        'tax_amount',
        'total',
        'product_id',
        'quotation_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'quotation_items';

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
