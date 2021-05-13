<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\API\BaseController;
use App\Models\Colis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ColisCollection;
use App\Http\Resources\Users\ColisResource;
use App\Models\Rammasage;
use App\Models\ReturnColis;
use App\Repositories\Repository\ColisRepository;
use Illuminate\Support\Str;

class ColisController extends BaseController
{

    protected $Colis = '';

    public function __construct(Colis $Colis)
    {
        // $this->middleware('auth:api');
        $this->Colis = new ColisRepository($Colis);
    }
    /**
     * Display a listing of the resource.
     *
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
    public function index()
    {
        $data  = Colis::where('agence_id', auth()->user()->agence_id)->orderBy('created_at', 'desc')->get();
        $res['data'] = new ColisCollection($data);
        $res['msg']  = "success";
        return response($res, 200);
    }
    public function list()
    {
        $data  = Colis::where('agence_id', auth()->user()->agence_id)->where('status', 'en attente')->get();
        $res['data'] = $data;
        $res['msg']  = "success";
        return response($res, 200);
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
            "ville_depart" => auth()->user()->agence->city,
            "token"     => $this->unique_str(10),
            "user_id" => auth()->user()->id,
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
    public function show($id)
    {
        $ReturnColis = new ColisResource($this->Colis->show($id));
        return $this->sendResponse($ReturnColis, 'colis info');
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
    public function update(Request $request, $id)
    {
        $colis = Colis::find($id);
        if ($request->status === "return" && $colis->status !== "return") {
            ReturnColis::create([
                'status' => 'active',
                'colis_id' => $id,
                'description' => 'new return'
            ]);
        }
        if ($request->status === "ramasser" && $colis->status !== "ramasser") {
            Rammasage::create([
                'colis_id' => $id,
                'user_id'  => auth()->user()->id,
                'agence_id' => auth()->user()->agence_id,
                'quantity' => 1
            ]);
        }
        $colis->update($request->all());
        $res['msg']  = "success";
        return response($res, 200);
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
