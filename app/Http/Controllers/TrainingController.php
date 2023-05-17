<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::all();
        return view('coach.trainings.index')->with([
            'trainings' => $trainings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('coach.trainings.create')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'video' => 'nullable',
            'categories' => 'required|array'
        ]);
        $image_name = null;
        if($request->hasFile('image')){
            $image_name = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('trainings' , $image_name , 'public');
        }
        $video_name = null;
        if($request->hasFile('video')){
            $video_name = $request->video->getClientOriginalName();
            $urlvid = $request->video->storeAs('training_videos' , $video_name , 'public');
        }
        Training::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name,
            'video' => $video_name,
            'user_id' => Auth::user()->id,
        ])->categories()->attach($request['categories']);

        return redirect(route('coach.trainings.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        return view('coach.trainings.show')->with([
            'training' => $training,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        $categories = Category::all();
        return view('coach.trainings.edit')->with([
            'training' => $training,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'video' => 'nullable|mimetypes:video/mp4',
            'categories' => 'required|array'
        ]);
        $training->name = $request['name'];
        $training->description = $request['description'];

        if($request->hasFile('image')){
            $image_name = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('trainings' , $image_name , 'public');
            $training->image = $image_name;
        }

        if($request->hasFile('image')){
            $video_name = $request->video->getClientOriginalName();
            $urlvid = $request->video->storeAs('training_videos' , $video_name , 'public');
            $training->video = $video_name;
        }
        $training->categories()->detach(); // Supprimer toutes les catégories associées
        $categories = $request->input('categories', []);
        $training->categories()->attach($categories); // Ajouter les nouvelles catégories sélectionnées

        $training->save();  
        return redirect(route('coach.trainings.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //one to many
        //$training->user()->dissociate();
        //$training->category()->dissociate();

        $training->categories()->detach();
        $training->user()->dissociate();
        $training->delete();
        return redirect(route('coach.trainings.index'));
    }

}
