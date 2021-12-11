<?php

namespace App\Repositories\Response;

class Error
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
            "status"        => "error",
            "code"          => $code,
            "message"       => $message,
            "data"          => $data,
            "routeRedirect" => $routeRedirect,
        ])->throwResponse();
    }

    public static function returnWeb($code, $message, $data=null, $routeRedirect=null)
    {
        if($routeRedirect && $code==401)
        {
            return redirect()->route($routeRedirect)
                ->withInput()
                ->withErrors($data)
                ->with("status", "error")
                ->with("code", $code)
                ->with("error", $message)
                ->throwResponse();
        }

        if($routeRedirect)
        {
            return redirect()->route($routeRedirect)
                ->withInput()
                ->with("status", "error")
                ->with("code", $code)
                ->with("error", $message);
        }
        else
        {
            return back()
                ->withInput()
                ->with("status", "error")
                ->with("code", $code)
                ->with("error", $message);
        }
    }

}
