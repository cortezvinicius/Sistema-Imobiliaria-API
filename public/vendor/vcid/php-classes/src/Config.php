<?php

namespace vcinsidedigital;

use Dotenv\Dotenv;

class Config
{
    private $config = [];

    public function __construct($file = "..")
    {
       $env = Dotenv::createImmutable($file);

       $dados_config = $env->load();

       $this->config = array_merge($this->config, $dados_config);
      
    }

    public function getConfig()
    {
        return $this->config;
    }
}