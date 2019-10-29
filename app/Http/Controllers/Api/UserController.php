<?php

namespace App\Http\Controllers\Api;

use App\General\Interfaces\RepositoriesInterface;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 *
 * @property RepositoriesInterface $userRepository
 */
class UserController extends ApiController
{
    protected $userRepository;

    /**
     * UserController constructor.
     * @param RepositoriesInterface $userRepository
     */
    public function __construct(RepositoriesInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
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
     * @return JsonResponse
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
     * @return JsonResponse
     * @throws \Throwable
     */
    public function create(UserRequest $request)
    {
        $request->merge(['status' => User::STATUS_ACTIVATE]);

        $this->userRepository->create($request->all());

        return $this->jsonSuccess($this->userRepository->getModel());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param $id
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($request->all(), $id);

        return $this->jsonSuccess($this->userRepository->getModel());
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return $this->jsonSuccess('deleted');
    }

}
