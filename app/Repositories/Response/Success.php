<?php

namespace App\Repositories\Response;

class Success
{
    public static function execute($routeType, $code, $message, $data=null, $routeRedirect=null)
    {
        if($routeType=="api")
        {
            return self::returnApi($code, $message, $data, $routeRedirect);
        }
        if($routeType=="web")
        {
            return self::returnWeb($code, $message, $data, $routeRedirect);
        }
    }

    public static function returnApi($code, $message, $data=null, $routeRedirect=null)
    {
        return response()->json([
            "status"        => "success",
            "code"          => $code,
            "message"       => $message,
            "data"          => $data,
            "routeRedirect" => $routeRedirect,
        ]);
    }

    public static function returnWeb($code, $message, $data=null, $routeRedirect=null)
    {
        if($routeRedirect)
        {
            return redirect()->route($routeRedirect)
                ->withInput()
                ->with("status", "success")
                ->with("code", $code)
                ->with("success", $message);
        }
        else
        {
            return back()
                ->withInput()
                ->with("status", "success")
                ->with("code", $code)
                ->with("success", $message);
        }
    }

}
