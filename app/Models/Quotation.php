<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'subject',
        'description',
        'billing_address',
        'shipping_address',
        'discount_percent',
        'discount_amount',
        'tax_amount',
        'adjustment_amount',
        'sub_total',
        'grand_total',
        'lead_manager_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leadManager()
    {
        return $this->belongsTo(LeadManager::class);
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
