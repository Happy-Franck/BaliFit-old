<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('administrateur.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrateur.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        $filename = null;
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('categories' , $filename , 'public');
        }
        Category::create([
            'name' => $request->name,
            'image' => $filename,
            'user_id' => Auth::user()->id,
        ]);
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('administrateur.categories.show')->with([
            'category' => $category,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('administrateur.categories.edit')->with([
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
        ]);
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('categories' , $filename , 'public');
            $category->name = $request['name'];
            $category->image = $filename;
            $category->save();
            return redirect(route('categories.index'));
        }
        $category->name = $request['name'];
        $category->save();
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('categories.index'));
    }
}
