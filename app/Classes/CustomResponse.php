<?php


namespace App\Classes;

use Illuminate\Http\Response;

class CustomResponse extends Response
{
    public function __construct($msg = 'Success', $success = true, $content = [], $status = 200, array $headers = [])
    {
        $content = [
            'success' => $success,
            'msg' => $msg,
            'data' => $content
        ];

        if (!$success) {
            $status = 422;
        }

        parent::__construct($content, $status, $headers);
    }
}
