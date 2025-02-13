<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
// require_once($pasta . "php/model/Banco_class.php");

$caminho = $_SERVER["REQUEST_URI"];

$vetor = explode("/", $caminho);
$classe = $vetor[0];
$vetor2 = explode("?", $vetor[1]);
$metodo = $vetor[2];


var_dump($caminho);
var_dump($classe);
var_dump($metodo);
die();
// $instancia = new Banco();

$retorno = $instancia->$metodo($_REQUEST);
echo $retorno;