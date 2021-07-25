<?php

namespace vcinsidedigital\Models;


use vcinsidedigital\DB\Sql;
use vcinsidedigital\Model;

class Imoveis extends Model
{
    public static function listAllImoveis($id, $status)
    {

        $sql = new Sql();
        $results = $sql->select("SELECT * FROM imobiliaria_imoveis WHERE id_user = :id_user AND status = :status", [
            ":id_user"=>$id,
            ":status"=>$status
        ]);

        return $results;

    }

    public static function listAllImoveisDestaque($id, $status)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM imobiliaria_imoveis WHERE id_user = :id_user AND status = :status AND destaque = :destaque", [
            ":id_user"=>$id,
            ":status"=>$status,
            ":destaque"=>1
        ]);

        return $results;
    }
}