<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionRessource;
use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Support\Carbon;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getAll = Transaction::all();
        return $getAll;
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
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create([
            'montant' => $request->montant,
            'type_transaction' => $request->type_transaction,
            'expediteur_id' => $request->expediteur_id,
            'destinataire_id' => $request->destinataire_id,
            'frais' => $request->frais,
            'permanent' => $request->permanent,
            'date_transaction' => Carbon::parse($request->date_transaction)
        ]);
        if($request->type_transaction == 'Depot'){
            Compte::where('client_id', $request->destinataire_id)->increment('montant', $request->montant);
        }
        else if($request->type_transaction == "Retrait"){
            Compte::where('client_id', $request->expediteur_id)->decrement('montant', $request->montant);
        }
        else if($request->type_transaction == "Transfert"){
            Compte::where('client_id', $request->destinataire_id)->increment('montant', $request->montant);
            Compte::where('client_id', $request->expediteur_id)->decrement('montant', $request->montant);
        }
        else if($request->type_transaction == "Code"){
            $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            Transaction::where('id', $transaction->id)->update(['code' => $code]);
        }
        return response()->json([
            'message' => 'Transaction effectuée avec succès',
            'transaction' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $getTransaction = Transaction::find($transaction->id);
        return new TransactionRessource($getTransaction);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function getTransactionExp($expediteur_id){
        $expediteur_ids = Transaction::where('expediteur_id', $expediteur_id)->pluck('expediteur_id');
        $getExpediteurId = Transaction::whereIn('expediteur_id', $expediteur_ids)->get();
        return TransactionRessource::collection($getExpediteurId);
    }
}
