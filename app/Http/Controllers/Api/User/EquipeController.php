<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCollection;
use App\Http\Resources\AdminResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EquipeController extends BaseController
{

    public function list()
    {
        $roles = Role::all();
        $res['data'] = $roles;
        $res['msg']  = "success";
        return response($res, 200);
    }

    public function index()
    {
        $users  = User::where("userable_type",Admin::class)->where('agence_id', auth()->user()->agence_id)->get();
        $res['data'] = new AdminCollection($users);
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
        $admin = Admin::create([
            'role_id' => $request->role_id,
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'agence_id' => auth()->user()->agence_id,
            'userable_id' => $admin->id,
            'userable_type' => Admin::class,
        ]);

        $res['msg']  = "success";
        return response($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = new AdminResource(User::find($id));
        return $this->sendResponse($user, 'user info');
    }
    public function getProfil()
    {
        $user         = auth()->user()->userable;
        $res['msg']   = "success";
        $res['data']  = new UserResource($user);
        return response($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        User::find($user)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        User::find($user)->userable->update([
            'role_id' => $request->role_id,
        ]);
        $res['msg']  = "success";
        return response($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        $user->userable->delete();
        $user->delete();
        $res['msg']  = "success";
        return response($res, 200);
    }
}
