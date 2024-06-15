<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'accepted_at',
        'rejected_at',
        'amount'
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id');
    }

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'bidder_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }

    public function scopeExcept(Builder $query, Offer $offer) : Builder
    {
        // dd($query->where('id' != $offer->id));
        return $query->where('id', '!=', $offer->id);
    }
}
