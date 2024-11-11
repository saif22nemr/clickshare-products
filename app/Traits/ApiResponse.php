<?php

namespace App\Traits;
trait ApiResponse{

    public function successResponse( $message = null , $data = null){
        return response([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }
    public function errorResponse($message = null ,$data= null ,  $status= false, $statusCode = 422) {
        return response([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ] , $statusCode);
    }
}
