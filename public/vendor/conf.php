<?php

$env = fopen("../.env", "w");
$text = "HOST = \n";
$text .= "USER = \n";
$text .= "PASSWORD = \n";
$text .= "DB =";
fwrite($env, $text);
fclose($env);