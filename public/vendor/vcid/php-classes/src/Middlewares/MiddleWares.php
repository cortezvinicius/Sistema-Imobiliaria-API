<?php

namespace vcinsidedigital\MiddleWares;

use SimpleXMLElement;
use Slim\Http\Request;
use Slim\Http\Response;
use vcinsidedigital\verefyToken;

class Middlewares
{
    public static function verefyToken()
    {
        return function(Request $req, Response $res, $next)
        {
            $route = $req->getAttribute('route');

            $args = $route->getArguments();

            $token = $args['token'];


            $verefy = new verefyToken($token);


            $valid_token = $verefy->validToken();

            if($valid_token != false)
            {
                $next($req, $res);
            }else
            {
                $type = $args['type'];

                $error = [
                    "code"=>001,
                    "msg"=>"Invalid Token"
                ];

                switch($type)
                {
                    case "json":
                        header('Content-Type: Application/json');
                        $res->withJson($error);
                        break;
                    case "graphql":
                        break;          
                }
            }

            return $res;
            
            
        };
    }
}