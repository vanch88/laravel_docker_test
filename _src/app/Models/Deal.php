<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'client_name',
        'client_phone',
        'comment',
        'status',
    ];


    /**
     * Get the product that owns the deal.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
