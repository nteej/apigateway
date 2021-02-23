<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Dingo\Api\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Helpers;

    public function sendResponse($data, string $message, $status = Response::HTTP_OK)
    {
        return $this->response->array([
            'message' => $message,
            'data' => $data,
            'status_code' => $status,
        ])->setStatusCode($status);
    }

    public function success($data = null, string $message = '', $status = Response::HTTP_OK)
    {
        return $this->sendResponse($data, $message, $status);
    }

}
