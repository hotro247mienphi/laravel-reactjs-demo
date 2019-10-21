<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\User;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 *
 * @property User $model
 * @property UserRepository $userRepository
 */
class UserController extends ApiController
{

    protected $userRepository;

    /**
     * UserController constructor.
     * @param User $model
     * @param UserRepository $userRepository
     */
    public function __construct(User $model, UserRepository $userRepository)
    {
        parent::__construct($model);
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->userRepository->paginate();
        return $this->jsonSuccess($data);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->userRepository->find($id);
        return $this->jsonSuccess($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function create(UserRequest $request)
    {
        $this->userRepository->create($request->all());
        return $this->jsonSuccess($this->userRepository->model());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($request->all(), $id);
        return $this->jsonSuccess($this->userRepository->model());
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return $this->jsonSuccess('deleted');
    }

}
