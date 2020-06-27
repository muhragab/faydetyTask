<?php

namespace App\Traits;

use App\Custom\ResponseUtil;

trait ResponseCustom
{
    public function sendResponse($result, $message, $status = 200)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result), $status);
    }

    public function sendError($error, $code = 400)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

}
