<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validations\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->_userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->_userRepo->update($request, $id);
            return $this->jsonData(new UserResource($user));
        } catch (\Throwable $th) {
            return $this->jsonError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
