<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 *
 */
class ApiController extends Controller
{

    /**
     * Render json success
     *
     * @param $data
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function jsonFail($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

}
