<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function uploadImage($file) {
        $data = array("file" => $file);
        $data_string = json_encode($data);

        $ch = curl_init(env('APP_STORAGE_URL') . 'upload-image.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $result = json_decode(curl_exec($ch));
        if($result->success == true) {
            return $result;
        }
        else {
            $result = json_decode(json_encode(array("success" => false)));
            return $result;
        }
    }

    public function error($message) {
        return response()->json(["success" => false, "message" => $message]);
    }

    public function success($data = null, $message = null) {
        return response()->json([
            "success" => true,
            "message" => $message,
            "data" => $data
        ]);
    }
    
}
