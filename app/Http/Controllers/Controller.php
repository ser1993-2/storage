<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generatePin(Request $request)
    {
        $length = $request->has('length') && $request->length != null  ? $request->length : 4;
        $code = '';

        for ($i = 0 ; $i < $length; $i++) {
            $code .= rand(1,9);
        }

        return $code;
    }

    public function generatePass(Request $request)
    {
        $length = $request->has('length') && $request->length != null ? $request->length : 8;

        $template = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = '';

        for ($i = 0 ; $i < $length; $i++) {
            $templateLength = strlen($template)-1;
            $randomIndex = rand(1, $templateLength);
            $password .= $template[$randomIndex];
        }

        return $password;
    }
}
