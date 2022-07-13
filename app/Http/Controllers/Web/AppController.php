<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AppController extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
    }

    public function sendResponse($type, $message, $data, $code){
        return response()->json(['type' => $type, 'message' => $message, 'data' => $data], $code);
    }

    public function emptyResponse(){
        return (object)[];
    }
}
