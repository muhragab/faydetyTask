<?php

namespace App\Traits;

use App\Custom\ResponseUtil;

trait ResponseCustom
{
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 400)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

}
