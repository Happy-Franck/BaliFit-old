<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : view
    {
        $produits = Produit::all();
        return view('administrateur.produits.index', [
            'produits' => $produits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : view
    {
        return view('administrateur.produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'poid' => 'required',
            'price' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('produits' , $filename , 'public');
            Produit::create([
                'name' => $request->name,
                'image' => $filename,
                'description' => $request->description,
                'poid' => $request->poid,
                'price' => $request->price,
                'user_id' => Auth::user()->id,
            ]);
            return redirect(route('produits.index'));
        }
        Produit::create([
            'name' => $request->name,
            'description' => $request->description,
            'poid' => $request->poid,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);
        return redirect(route('produits.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $userconnected = Auth::user();
        return view('administrateur.produits.show')->with([
            'produit' => $produit,
            'note' => $produit->getAverageRatingAttribute(),
            'avis' => $produit->advices(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('administrateur.produits.edit')->with([
            'produit' => $produit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'description' => 'required',
            'poid' => 'required',
            'price' => 'required',
        ]);
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $urlimg = $request->image->storeAs('produits' , $filename , 'public');
            $produit->name = $request['name'];
            $produit->image = $filename;
            $produit->description = $request['description'];
            $produit->poid = $request['poid'];
            $produit->price = $request['price'];
            $produit->save();
            return redirect(route('produits.index'));
        }
        $produit->name = $request['name'];
        $produit->description = $request['description'];
        $produit->poid = $request['poid'];
        $produit->price = $request['price'];
        $produit->save();
        return to_route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect(route('administrateur.produits.index'));
    }
    public function listProduct(){
        $produits = Produit::all();
        return view('challenger.produits.index')->with([
            'produits' => $produits
        ]);
    }
    public function showProduct(Produit $produit)
    {
        $userconnected = Auth::user();
        return view('challenger.produits.show')->with([
            'produit' => $produit,
            'note' => $produit->getAverageRatingAttribute(),
            'avis' => $produit->advices(),
            'user_co' => $userconnected,
            'commented' => false,
        ]);
    }
}
