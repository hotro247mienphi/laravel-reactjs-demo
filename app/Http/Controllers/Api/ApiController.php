<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 *
 * @property Model $model
 */
class ApiController extends Controller
{
    protected $model = null;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Render json success
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonSuccess($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Render json fail
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonFail($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

}
