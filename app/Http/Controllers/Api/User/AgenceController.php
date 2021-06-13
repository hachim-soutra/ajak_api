<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Repositories\Repository\AgenceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgenceController extends Controller
{

    protected $Agence = '';

    public function __construct(Agence $Agence)
    {
        // $this->middleware('auth:api');
        $this->Agence = new AgenceRepository($Agence);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Agences = $this->Agence->all();
        return $this->sendResponse($Agences, 'Agence list');
    }
    public function list()
    {
        $Agences = $this->Agence->get_by_agency_list(auth()->user()->agence_id);
        $response = [
            'success' => true,
            'data'    => $Agences,
            'message' => "Agence list",
        ];
        return response()->json($response, 200);
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
        // $request->merge([
        //     "agence_id" => auth()->user()->agence_id,
        //     "password"  => Hash::make($request->password)
        // ]);
        $Agences = $this->Agence->create($request->all());
        // return $this->sendResponse($Agences, 'create Agence');
        $response = [
            'success' => true,
            'data'    => $Agences,
            'message' => "create Agence",
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agence  $Agence
     * @return \Illuminate\Http\Response
     */
    public function show($Agence)
    {
        $Agence = $this->Agence->show($Agence);
        // return $this->sendResponse($Agence, 'Agence info');
        $response = [
            'success' => true,
            'data'    => $Agence,
            'message' => "Agence info",
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agence  $Agence
     * @return \Illuminate\Http\Response
     */
    public function edit(Agence $Agence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agence  $Agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Agence)
    {
        $request->merge([
            "agence_id" => auth()->user()->agence_id,
            "password"  => Hash::make($request->password)
        ]);
        $Agences = $this->Agence->update($request->all(), $Agence);
        $response = [
            'success' => true,
            'data'    => $Agences,
            'message' => "Agence update",
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agence  $Agence
     * @return \Illuminate\Http\Response
     */
    public function destroy($Agence)
    {
        $Agences = $this->Agence->delete($Agence);
        $response = [
            'success' => true,
            'data'    => $Agences,
            'message' => "delete Agence",
        ];
        return response()->json($response, 200);
    }
}
