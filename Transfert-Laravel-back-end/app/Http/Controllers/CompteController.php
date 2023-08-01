<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompteRequest;
use App\Http\Requests\UpdateCompteRequest;
use App\Http\Resources\CompteRessource;
use App\Models\Compte;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getComptes = Compte::all();
        return $getComptes;
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
    public function store(StoreCompteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Compte $compte)
    {
        $getCompteById = Compte::find($compte->id);
        return $getCompteById;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompteRequest $request, Compte $compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compte $compte)
    {
        //
    }
    //show id via number 
    public function showByNumber($numeroCompte)
    {
        $getCompteByNumber = Compte::whereHas('client', function ($query) use ($numeroCompte) {
            $query->where('telephone', $numeroCompte)->orWhere('numero_compte', $numeroCompte);
        })->first();
        return new CompteRessource($getCompteByNumber);
    }
}
