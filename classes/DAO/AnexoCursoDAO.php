<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/bd/conexao.php");

class AnexoCursoDAO extends Conexao
{

    public function cadastrar(array $dadosAnexo): bool
    {
        try {
            $sql = "INSERT INTO anexo_curso (ID_CURSO, NOME, TIPO, TAMANHO, ARQUIVO)
                    VALUES (:ID_CURSO, :NOME, :TIPO, :TAMANHO, :ARQUIVO)";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            $comando->bindValue(":ID_CURSO", $dadosAnexo["ID_CURSO"]);
            $comando->bindValue(":NOME", $dadosAnexo["NOME_ARQUIVO"]);
            $comando->bindValue(":TIPO", $dadosAnexo["TIPO_ARQUIVO"]);
            $comando->bindValue(":TAMANHO", $dadosAnexo["TAMANHO_ARQUIVO"]);
            $comando->bindValue(":ARQUIVO", $dadosAnexo["ARQUIVO"], PDO::PARAM_LOB);

            return $comando->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function alterar(array $dadosAnexo): bool
    {
        try {
            $sql = "UPDATE anexo_curso SET NOME = :NOME, TIPO = :TIPO, TAMANHO = :TAMANHO,
                    ARQUIVO = :ARQUIVO WHERE ID_CURSO = :ID_CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            $comando->bindValue(":ID_CURSO", $dadosAnexo["ID_CURSO"]);
            $comando->bindValue(":NOME", $dadosAnexo["NOME_ARQUIVO"]);
            $comando->bindValue(":TIPO", $dadosAnexo["TIPO_ARQUIVO"]);
            $comando->bindValue(":TAMANHO", $dadosAnexo["TAMANHO_ARQUIVO"]);
            $comando->bindValue(":ARQUIVO", $dadosAnexo["ARQUIVO"], PDO::PARAM_LOB);

            return $comando->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
