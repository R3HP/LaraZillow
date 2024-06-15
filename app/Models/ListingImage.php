<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name'
    ];

    protected $appends= [
        'src'
    ];


    public function listing() : BelongsTo{
        return $this->belongsTo(\APP\Models\Listing::class,'listing_id');
    }
    
    public function getSrcAttribute(){
        return asset("storage/{$this->file_name}");
    }



}
