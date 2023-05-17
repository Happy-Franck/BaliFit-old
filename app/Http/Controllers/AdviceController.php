<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $advices = $user->advices;
        return view('challenger.advices.index', compact('advices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $user = Auth::user();
        // Vérifier si l'utilisateur a déjà donné un avis pour ce livre
        $existingAdvice = $produit->advices()->where('user_id', $user->id)->exists();
        if ($existingAdvice) {
            return redirect()->back()->with('error', 'Vous avez déjà donné votre avis pour ce produit.');
        }
        return view('challenger.advices.create', compact('produit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $user = Auth::user();
        // Vérifier si l'utilisateur a déjà donné un avis pour ce livre
        $existingAdvice = $produit->advices()->where('user_id', $user->id)->exists();
        if ($existingAdvice) {
            return redirect()->back()->with('error', 'Vous avez déjà donné votre avis pour ce livre.');
        }
        $validatedData = $request->validate([
            'comment' => 'required|string|max:1000',
            'note' => 'required|integer|between:1,5',
        ]);
        $validatedData['user_id'] = $user->id;
        $validatedData['produit_id'] = $produit->id;
        Advice::create($validatedData);
        return redirect()->route('challenger.showProduct', $produit)->with('success', 'Votre avis a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advice $advice)
    {
        $advice = Advice::findOrFail($id);
        return view('challenger.advices.show', compact('advice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($produit, $id)
    {
        $advice = Advice::findOrFail($id);
        $user = Auth::user();
        // Vérifier si l'utilisateur est l'auteur de cet avis
        if ($advice->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cet avis.');
        }
        return view('challenger.advices.edit')->with([
            'produit' => $produit,
            'advice' => $advice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, Advice $advice)
    public function update(Request $request, $produit, $id)
    {
        $advice = Advice::findOrFail($id);
        $user = Auth::user();
        // Vérifier si l'utilisateur est l'auteur de cet avis
        if ($advice->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cet avis.');
        }
        $validatedData = $request->validate([
            'comment' => 'required|string|max:1000',
            'note' => 'required|integer|between:1,5',
        ]);
        $advice->update($validatedData);
        return redirect()->route('challenger.showProduct', $advice->produit)->with('success', 'Votre avis a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($produit, $id)
    {
        $advice = Advice::findOrFail($id);
        $user = Auth::user();
        // Vérifier si l'utilisateur est l'auteur de cet avis
        if ($advice->user_id !== $user->id) {
            return redirect()->route('produits.show', $advice->produit);
        }
        $advice->delete();
        return redirect()->route('challenger.showProduct', $advice->produit);    
    }
}
