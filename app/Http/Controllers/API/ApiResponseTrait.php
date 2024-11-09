<?php

namespace App\Http\Controllers\API;

trait ApiResponseTrait {
    // this is function to return data about response
    public function ApiResponse($data=null, $message=null, $status=null) {
        $returned_data = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status
        ];
        return response($returned_data);
    }
}