<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\RammasageResource;
use App\Models\Colis;
use App\Models\Rammasage;
use App\Repositories\Repository\RammasageRepository;
use Illuminate\Http\Request;

class RammasageController extends BaseController
{
    protected $Rammasage = '';

    public function __construct(Rammasage $Rammasage)
    {
        // $this->middleware('auth:api');
        $this->Rammasage = new RammasageRepository($Rammasage);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Rammasages = $this->Rammasage->get_by_agency(auth()->user()->agence_id);
        return $this->sendResponse($Rammasages, 'Rammasage list');
    }
    public function encours()
    {
        $Rammasages = Colis::where('agence_id', auth()->user()->agence_id)->where('status', 'en attente')->get();
        return $this->sendResponse($Rammasages, 'Rammasage list');
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
        Colis::find($request->colis_id)->update([
            "status" => "ramasser"
        ]);
        $request->merge([
            "agence_id" => auth()->user()->agence_id,
            "user_id"   => auth()->user()->id,
        ]);
        $Rammasages = $this->Rammasage->create($request->all());
        return $this->sendResponse($Rammasages, 'Rammasage create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rammasage  $Rammasage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Rammasage = new RammasageResource($this->Rammasage->show($id));
        return $this->sendResponse($Rammasage, 'Rammasage info');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rammasage  $Rammasage
     * @return \Illuminate\Http\Response
     */
    public function edit(Rammasage $Rammasage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rammasage  $Rammasage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Rammasage)
    {
        $clients = $this->Rammasage->update($request->all(), $Rammasage);
        return $this->sendResponse($clients, 'upadet Rammasage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rammasage  $Rammasage
     * @return \Illuminate\Http\Response
     */
    public function destroy($Rammasage)
    {
        $this->Rammasage->delete($Rammasage);
        return $this->sendResponse([], 'delete Rammasage');
    }
}
