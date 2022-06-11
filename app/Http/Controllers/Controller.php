<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validing($request,$items){
        $validate = Validator::make($request,$items);
        if ($validate->fails()) {
            return $this->resFailure(1,$validate->errors()->all());
        }else
            return null;
    }

    public function resSuccess($data){
        return response()->json([
            'error_code' => 0,
            'error_message' => "",
            'data' => $data
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function resFailure($code,$error){
        if (is_array($error))
            $error = implode(",",$error);
        return response()->json([
            'error_code' => $code,
            'error_message' => $error
        ]);
    }

}
