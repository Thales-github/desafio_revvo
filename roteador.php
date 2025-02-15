<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/utility/Validacoes.php");

$caminho = $_SERVER["REQUEST_URI"];
$validacoes = new Validacoes();

$vetor = explode("/", $caminho);
$classe = $vetor[2];
$metodo = $vetor[3];

$caminhoDaClasse = "classes/model/" . $classe . ".php";

if (!is_file($caminhoDaClasse) || !file_exists($caminhoDaClasse)) {
    // rota não encontrada, não exibir o erro para evitar explorar as brechas de segurança
    echo $validacoes->gerarRetornoHttp(401, [], []);
}

require_once($caminhoDaClasse);
$instancia = new $classe();

if (!method_exists($instancia, $metodo)) {
    // método chamado não existe, não exibe erro mas não deixa avançar na API
    echo $validacoes->gerarRetornoHttp(401, [], []);
}

if ($_FILES["ARQUIVO"]) {
    $_REQUEST["ARQUIVO"] = $_FILES["ARQUIVO"];
}

// var_dump($caminhoDaClasse);

die();

$retorno = $instancia->$metodo($_REQUEST);
echo $retorno;
