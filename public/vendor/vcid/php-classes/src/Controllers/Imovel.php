<?php

namespace vcinsidedigital\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use vcinsidedigital\Models\Imoveis;
use vcinsidedigital\verefyToken;

class Imovel
{
    function listAllImoveis(Request $req, Response $res, array $args)
    {
        $verefy = new verefyToken($args["token"]);
        $id = $verefy->getid();
        $imoveis = Imoveis::listAllImoveis($id, $args['status']);

        if($args['type'] == "json")
        {
            return $res->withJson($imoveis);
        }
    }

    function listAllImoveisDestaque(Request $req, Response $res, array $args)
    {
        $verefy = new verefyToken($args["token"]);
        $id = $verefy->getid();
        $imoveis = Imoveis::listAllImoveisDestaque($id, $args['status']);

        if($args['type'] == "json")
        {
            return $res->withJson($imoveis);
        }
    }
}