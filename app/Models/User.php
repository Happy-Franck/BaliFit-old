<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//ampina
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    //ampina
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function produits(){
        return $this->hasMany(Produit::class);
    }

    public function advices()
    {
        return $this->hasMany(Advice::class);
    }
    
    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    //many to many entre coach et challengers
    //récupérer les challengers coachés
    //$coach = User::find(1);
    //$challengers = $coach->coachedChallengers;
    public function coachedChallengers()
    {
        //1er arg -> relation avec model user
        //2e arg -> nom de table de liaison
        //3e arg -> coach a plusieur
        //4e arg -> challenger
        return $this->belongsToMany(User::class, 'coaching', 'coach_id', 'challenger_id');
    }

    //many to many entre challenger et coachs
    //récupérer les coaches d'un challenger
    //$challenger = User::find(2);
    //$coaches = $challenger->coaches;
    public function coaches()
    {
        //1er arg -> relation avec model user
        //2e arg -> nom de table de liaison
        //3e arg -> challenger a plusieurs
        //4e arg -> coach
        return $this->belongsToMany(User::class, 'coaching', 'challenger_id', 'coach_id');
    }

    /* tout les sceance créé par l'admin */
    public function sceances(){
        return $this->hasMany(Sceance::class);
    }

    /* tout les scéance donné par le coach */
    public function coachSceances()
    {
        return $this->hasMany(Sceance::class, 'coach_id');
    }

    /* tout les scéance fait par le challenger */
    public function challengerSceances()
    {
        return $this->hasMany(Sceance::class, 'challenger_id');
    }

}





/*  ADMIN ASSIGN

    ASSIGNER UN CHALLENGER À UN COACH
    $coachId = 1;
    $challengerId = 2;
    $coaching = new Coaching();
    $coaching->coach_id = $coachId;
    $coaching->challenger_id = $challengerId;
    $coaching->save();

    ASSIGNER UN COACH À UN CHALLENGER
    $coachId = 1;
    $challengerId = 2;
    $coaching = new Coaching();
    $coaching->coach_id = $coachId;
    $coaching->challenger_id = $challengerId;
    $coaching->save();
*/


/*  BEST practice
    $coach = User::find(1);
    $challengers = $coach->coachedChallengers;

    BAD 
    $coachId = 1;
    $challengers = User::role('challenger')->get();
    $coachedChallengers = [];

    foreach ($challengers as $challenger) {
        $coaches = $challenger->coaches;
        foreach ($coaches as $coach) {
            if ($coach->id == $coachId) {
                // Le challenger est coaché par l'utilisateur ayant l'ID 5
                // Ajouter le challenger au tableau de challengers coachés
                $coachedChallengers[] = $challenger;
            }
        }
    }

    // Afficher la liste de tous les challengers coachés par l'utilisateur ayant l'ID 5
    foreach ($coachedChallengers as $challenger) {
        echo $challenger->name . '<br>';
    }*/
