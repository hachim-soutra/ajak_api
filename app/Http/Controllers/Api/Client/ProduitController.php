<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Api\BaseController;
use App\Models\Produit;
use App\Repositories\Repository\ProduitRepository;
use Illuminate\Http\Request;

class ProduitController extends BaseController
{
    protected $Produit = '';

    public function __construct(Produit $Produit)
    {
        $this->Produit = new ProduitRepository($Produit);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->Produit->get_by_client(auth()->user()->id);
        return $this->sendResponse($data, 'Produit list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            "agence_id" => auth()->user()->agence_id,
            "client_id" => auth()->user()->id,
            "status"    => "active",
        ]);
        $data = $this->Produit->create($request->all());
        return $this->sendResponse($data, 'create Produit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
