<?php

namespace vcinsidedigital;

use vcinsidedigital\DB\Sql;

class verefyToken
{
    private $header;
    private $payload;
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
        $token = base64_decode($token);

        if($token != "")
        {
            $token = explode(".", $token);
    
            $token_header = $token[0];
            $token_header = base64_decode($token_header);
            $token_header = json_decode($token_header, true);
            $this->header = $token_header;
    
            $token_payload = $token[1];
            $token_payload = base64_decode($token_payload);
            $token_payload = json_decode($token_payload, true);
            $this->payload = $token_payload;

        }


        
    }

    public function validToken()
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM clientes WHERE id = :id", [
            ":id"=>$this->payload["id"]
        ]);
        
        if(count($result) > 0)
        {
            $data = $result[0];

            if($this->token != $data["api_key"])
            {
                return false;
            }else
            {
                $empresa = $this->payload["empresa"];
                $site = $this->payload["site"];
                $id = $this->payload["id"];
    
                $header = json_encode($this->header);
                $header = base64_encode($header);
                $payload = json_encode($this->payload);
                $payload = base64_encode($payload);
    
                $secret = hash_hmac('sha256', $empresa."@".$site."@".$id, $data["palavra_secreta"], true);
                $signature = hash_hmac('sha256', $header.$payload, $secret, true);
                $signature = base64_encode($signature);
    
                $api_key = $data['api_key'];
                $api_key = base64_decode($api_key);
                $api_key = explode(".", $api_key);
                $signature_valid = $api_key[2];
    
                if($signature != $signature_valid)
                {
                    return false;
                }else
                {
                    return true;
                }
            }

        }else
        {
            return false;
        }
    }

    public function getid()
    {
        return $this->payload["id"];
    }
}