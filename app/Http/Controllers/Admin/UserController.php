<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sceance;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('administrateur.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('administrateur.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('administrateur.users.role')->with([
            'user' => $user,
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->hasRole('administrateur')){
            return back();
        }
        $user->delete();
        return redirect(route('users.index'));
    }

    /*----- Assign role to user-----*/
    public function assignRole(Request $request, User $user)
    {
        if($user->hasRole($request->role)){
            return back();
        }
        $user->assignRole($request->role);
        return back();
    }

    /*----- Remove role to user -----*/
    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            $user->removeRole($role);
            return back();
        }
        return back();
    }

    /*----- give permission to user -----*/
    public function givePermission(Request $request, User $user)
    {
        if($user->hasPermissionTo($request->permission) || $user->roles->contains($request->permission)){
            return back();
        }
        $user->givePermissionTo($request->permission);
        return back();
    }

    /*----- revoke permission to user -----*/
    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return back();
        }
        return back();
    }

    /*----- Form assign coach for challenger -----*/
    public function updateCoachesForm(User $user)
    {
        return view('administrateur.users.challengerassigncoachs')->with([
            'user' => $user,
            'coaches' => User::role('coach')->get(),
        ]);
    }

    /*----- Form assign challenger for coach -----*/
    public function updateChallengersForm(User $user)
    {
        return view('administrateur.users.coachassignchallengers')->with([
            'user' => $user,
            'challengers' => User::role('challenger')->get(),
        ]);
    }

    /*----- Assign coach for challenger -----*/
    public function updateChallengers(Request $request, User $user)
    {
        $newChallengers = $request->input('new_challengers', []);
        $removeChallenger= $request->input('remove_challenger', null);

        // Si on veut supprimer un challengerexistant
        if ($removeChallenger) {
            $user->coachedChallengers()->detach($removeChallenger);
            return redirect()->back();
        }


        // Si on veut assigner de nouveaux challenger
        if (!empty($newChallengers)) {
            //efface tout les anciens
            //$user->coachedChallengers()->sync($newChallengers);
            //crèe de nouveaux
            foreach ($newChallengers as $challengerId) {
                $user->coachedChallengers()->attach($challengerId);
            }
            return redirect()->back();
        }

        return redirect()->back();
    }

    /*----- Assign coach for challenger -----*/
    public function updateCoaches(Request $request, User $user)
    {
        $newCoaches = $request->input('new_coaches', []);
        $removeCoach = $request->input('remove_coach', null);

        // Si on veut supprimer un coach existant
        if ($removeCoach) {
            $user->coaches()->detach($removeCoach);
            return redirect()->back();
        }

        // Si on veut assigner de nouveaux coachs
        if (!empty($newCoaches)) {
            //$user->coaches()->sync($newCoaches);
            foreach ($newCoaches as $coachId) {
                $user->coaches()->attach($coachId);
            }
            return redirect()->back();
        }

        return redirect()->back();
    }

    /*----- All challenger coached by coach -----*/
    public function myChallengers()
    {
        $challengers = Auth::user()->coachedChallengers;
        return view('coach.challengers.index')->with([
            'challengers' => $challengers
        ]);
    }
    
    /*----- All coach coached by challenger -----*/
    public function myCoachs()
    {
        $coachs = Auth::user()->coaches;
        return view('challenger.coachs.index')->with([
            'coachs' => $coachs
        ]);
    }

    /* fromulaire pour qu'un coach obtient un challenger */
    public function assignSceanceCoachChallengerForm(User $user){ //id du coach
        return view('administrateur.users.coachassignsceance')->with([
            'user' => $user,
            //les challengers coaché par le coach
            //'challengers' => $user->coachedChallengers
            //tout les challengers
            'challengers' => User::role('challenger')->get(),
        ]);
    }

    /* validation du formulaire de sceance pour coach -> challenger */
    public function assignSceanceCoachChallenger(Request $request, User $user){ //id de coach
        $admin = Auth::user();
        $coach = $user;
        $challenger = User::find($request->challenger_id);
        $sceance = new Sceance;
        $sceance->admin_id = $admin->id;
        $sceance->coach_id = $coach->id;
        $sceance->challenger_id = $challenger->id;
        $sceance->validated = false;
        $sceance->save();
        return to_route('users.index');
    }

    /* fromulaire pour qu'un challenger obtient un sceance */
    public function assignSceanceChallengerCoachForm(User $user){ //id du coach
        return view('administrateur.users.challengerassignsceance')->with([
            'user' => $user,
            //les coach du challenger
            //'coaches' => $user->coaches
            //tout les coachs
            'coaches' => User::role('coach')->get(),
        ]);
    }

    /* validation du formulaire de sceance pour challenger -> coach */
    public function assignSceanceChallengerCoach(Request $request, User $user){ //id de coach
        $admin = Auth::user();
        $challenger = $user;
        $coach = User::find($request->coach_id);
        $sceance = new Sceance;
        $sceance->admin_id = $admin->id;
        $sceance->coach_id = $coach->id;
        $sceance->challenger_id = $challenger->id;
        $sceance->validated = false;
        $sceance->save();
        return to_route('users.index');
    }



}
