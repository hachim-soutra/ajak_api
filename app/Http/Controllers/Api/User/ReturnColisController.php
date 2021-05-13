<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReturnColisResource;
use App\Http\Resources\Users\ReturnColisCollection;
use App\Models\ReturnColis;
use App\Repositories\Repository\ReturnColisRepository;
use Illuminate\Http\Request;

class ReturnColisController extends BaseController
{
    protected $ReturnColis = '';

    public function __construct(ReturnColis $ReturnColis)
    {
        // $this->middleware('auth:api');
        $this->ReturnColis = new ReturnColisRepository($ReturnColis);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ReturnColis::whereHas('colis', function ($colis) {
            $colis->where('agence_id', auth()->user()->agence_id);
        })->get();
        $res['data'] = new ReturnColisCollection($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnColis  $returnColis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ReturnColis = new ReturnColisResource($this->ReturnColis->show($id));
        return $this->sendResponse($ReturnColis, 'Return colis info');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnColis  $returnColis
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnColis $returnColis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnColis  $returnColis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnColis $returnColis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnColis  $returnColis
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnColis $returnColis)
    {
        //
    }
}
