<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // handle feedback Response-> Request()
    public function sendResponse($dataResult, $responseMessage)
    {
        $dataResponse = [
            'success' => true,
            'message' => $responseMessage,
            'response' => $dataResult,
        ];
        return response()->json($dataResponse, 200);
    }

    // handle feedback Response-> Request(opt='withError')
    public function sendError($errorResult, $errorMessage = [], $code = 404)
    {
        $dataResponse = [
            'success' => false,
            'message' => $errorResult,
        ];

        if (!empty($errorMessage)) {
            $dataResponse['response'] = $errorMessage;
        }
        return response()->json($dataResponse, $code);
    }
}
