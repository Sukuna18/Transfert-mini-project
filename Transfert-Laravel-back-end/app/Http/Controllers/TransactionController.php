<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
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
        return $getTransaction;

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
}
