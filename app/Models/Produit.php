<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'poid',
        'price',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function advices()
    {
        return $this->hasMany(Advice::class);
    }
    public function getAverageRatingAttribute()
    {
        return $this->advices()->avg('note');
    }
}
