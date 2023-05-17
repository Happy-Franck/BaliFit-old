<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sceance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'admin_id',
        'coach_id',
        'challenger_id',
        'validated'
    ];

    /* inutile card renvoie qui a publier la sceance (admin)*/
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /* renvoie qui est le coach lors de la sceance */
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /* renvoie qui est le challenger lors de la sceance */
    public function challenger()
    {
        return $this->belongsTo(User::class, 'challenger_id');
    }
    public function trainings()
    {
        return $this->belongsToMany(Training::class)
            ->withPivot('id', 'series', 'repetitions', 'duree')
            ->withTimestamps();
    }
    



}
