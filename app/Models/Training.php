<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'video',
        'user_id',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function sceances()
    {
        return $this->belongsToMany(Sceance::class)
            ->withPivot('id', 'series', 'repetitions', 'duree')
            ->withTimestamps();
    }

}
