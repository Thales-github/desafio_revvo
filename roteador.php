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
    die();
}

require_once($caminhoDaClasse);
$instancia = new $classe();

if (!method_exists($instancia, $metodo)) {
    // método chamado não existe, não exibe erro mas não deixa avançar na API
    echo $validacoes->gerarRetornoHttp(401, [], []);
    die();
}

// validações caso tenha um arquivo sendo enviado
if (isset($_FILES["ARQUIVO"]) && !empty($_FILES["ARQUIVO"])) {

    if (!$validacoes->validarTipoArquivo($_FILES["ARQUIVO"])) {
        echo $validacoes->gerarRetornoHttp(400, ["Tipo do arquivo é inválido"], []);
        die();
    }

    if (!$validacoes->validarTamanhoArquivo($_FILES["ARQUIVO"])) {
        echo $validacoes->gerarRetornoHttp(400, ["Tamanho do arquivo é inválido, máximo 10MB"], []);
        die();
    }
    $_REQUEST["ARQUIVO"] = $_FILES["ARQUIVO"];
}

$retorno = $instancia->$metodo($_REQUEST);
echo $retorno;