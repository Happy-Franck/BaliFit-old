<?php

namespace App\Http\Controllers;

use App\Models\Sceance;
use App\Models\Training;
use Illuminate\Http\Request;

class SceanceController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sceances = Sceance::all();
        return view('coach.sceances.index', [
            'sceances' => $sceances,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    public function addTrainings(Sceance $sceance, Request $request)
    {
        $trainings = $request->input('traininglist');
        $data = [];
        for ($i = 0; $i < count($trainings); $i++) {
            $sceance->trainings()->attach($request['traininglist'][$i], [
                'series' => $request['series'][$i], 
                'repetitions' => $request['repetitions'][$i],
                'duree' => $request['duree'][$i],
            ]);
        }
        return to_route('coach.sceances.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sceance $sceance)
    {
        return view('coach.sceances.show')->with([
            'sceance' => $sceance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sceance $sceance)
    {
        $trainings = Training::all();
        return view('coach.sceances.edit')->with([
            'trainings' => $trainings,
            'sceance' => $sceance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sceance $sceance)
    {
        /**/
    }

    public function editTrainings(Sceance $sceance)
    {
        $trainings = Training::all();
        return view('coach.sceances.editTrainings')->with([
            'trainings' => $trainings,
            'sceance' => $sceance
        ]);
    }

    public function updateTrainings(Sceance $sceance, Request $request)
    {
        $trainings = $request->input('traininglist');
        $data = [];
        for ($i = 0; $i < count($trainings); $i++) {
            $data[$trainings[$i]] = [
                'series' => $request['series'][$i],
                'repetitions' => $request['repetitions'][$i],
                'duree' => $request['duree'][$i],
            ];  
        }
        $sceance->trainings()->sync($data);
        
        return redirect()->route('coach.sceances.index');
    }

    public function showToDelete(Sceance $sceance)
    {
        return view('coach.sceances.showToDelete')->with([
            'sceance' => $sceance
        ]);
    }

    public function deleteTraining(Sceance $sceance, Training $training, $id)
    {
        $sceance->trainings()->wherePivot('id', $id)->detach($training->id);
        if($sceance->trainings->count() > 0){
            return redirect()->back();
        }
        else{
            return to_route('coach.sceances.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sceance $sceance)
    {
        //
    }
}
