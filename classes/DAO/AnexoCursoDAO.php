<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/bd/conexao.php");

class AnexoCursoDAO extends Conexao
{
    public function cadastrar($dadosAnexo): bool
    {
        try {
            $sql = "INSERT INTO anexo_curso (NOME, TIPO, TAMANHO, ARQUIVO)
                    VALUES (:NOME, :TIPO, :TAMANHO, :ARQUIVO)";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            // Verificando o arquivo e lidando com os dados binários
            $arquivoBinario = file_get_contents($dadosAnexo["ARQUIVO"]["tmp_name"]);

            $comando->bindValue(":NOME", $dadosAnexo["NOME"]);
            $comando->bindValue(":TIPO", $dadosAnexo["TIPO"]);
            $comando->bindValue(":TAMANHO", $dadosAnexo["TAMANHO"]);
            $comando->bindValue(":ARQUIVO", $arquivoBinario, PDO::PARAM_LOB);

            return $comando->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function detalhar($idCurso): array|bool
    {
        try {
            $sql = "SELECT ID_ANEXO_CURSO, NOME, TIPO, TAMANHO, ARQUIVO, 
                           DATE_FORMAT(DATA_CADASTRO, '%d/%m/%Y') AS DATA_CADASTRO
                    FROM anexo_curso
                    WHERE ID__CURSO = :ID__CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);
            $comando->bindValue(":ID__CURSO", $idAnexo);
            $comando->execute();

            return $comando->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function apagar($idAnexo): bool
    {
        try {
            $sql = "DELETE FROM anexo_curso WHERE ID_ANEXO_CURSO = :ID_ANEXO_CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);
            $comando->bindValue(":ID_ANEXO_CURSO", $idAnexo);

            return $comando->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
