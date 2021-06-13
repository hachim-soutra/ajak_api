<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\RammasageCollection;
use App\Http\Resources\RammasageResource;
use App\Models\Rammasage;
use App\Repositories\Repository\RammasageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RammasageController extends BaseController
{
    protected $Rammasage = '';

    public function __construct(Rammasage $Rammasage)
    {
        // $this->middleware('auth:api');
        $this->Rammasage = new RammasageRepository($Rammasage);
    }

    public function unique_str($lenght)
    {
        $uniqueStr = Str::random($lenght);
        while (Rammasage::where('token', $uniqueStr)->exists()) {
            $uniqueStr = Str::random($lenght);
        }
        return $uniqueStr;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Rammasages = $this->Rammasage->get_by_client(auth()->user()->id);
        return $this->sendResponse(new RammasageCollection($Rammasages), 'Rammasage list');
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
            "client_id" => auth()->user()->id,
            "agence_id" => auth()->user()->agence_id,
            "token"     => $this->unique_str(10),
        ]);
        $Rammasages = $this->Rammasage->create($request->all());
        return $this->sendResponse($Rammasages, 'Rammasage list');
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
