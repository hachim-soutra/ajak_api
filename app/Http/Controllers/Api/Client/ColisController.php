<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\API\BaseController;
use App\Models\Colis;
use Illuminate\Http\Request;
use App\Repositories\Repository\ColisRepository;
use Illuminate\Support\Str;

class ColisController extends BaseController
{
    protected $colis = '';
    public function __construct(Colis $colis)
    {
        $this->colis = new ColisRepository($colis);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->colis->get_by_client(auth()->user()->id);
        return $this->sendResponse($data, 'colis list');
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
    public function unique_str($lenght)
    {
        $uniqueStr = Str::random($lenght);
        while (Colis::where('token', $uniqueStr)->exists()) {
            $uniqueStr = Str::random($lenght);
        }
        return $uniqueStr;
    }
    public function store(Request $request)
    {
        $request->merge([
            "client_id" => auth()->user()->id,
            "agence_id" => auth()->user()->agence_id,
            "ville_depart" => auth()->user()->agence_id,
            "token"     => $this->unique_str(10),
        ]);
        Colis::create($request->all());
        $res['msg']  = "success";
        return response($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\colis  $colis
     * @return \Illuminate\Http\Response
     */
    public function show(colis $colis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\colis  $colis
     * @return \Illuminate\Http\Response
     */
    public function edit(colis $colis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\colis  $colis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, colis $colis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\colis  $colis
     * @return \Illuminate\Http\Response
     */
    public function destroy(colis $colis)
    {
        //
    }
}
