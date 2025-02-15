<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/bd/conexao.php");

class CursoDAO extends Conexao
{
    
    public function cadastrar($dadosAluno): bool
    {

        try {
            $sql = "INSERT INTO curso(TITULO, DESCRICAO, IMAGEM)
                    VALUES (:TITULO, :DESCRICAO, :IMAGEM)";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            $comando->bindValue(":TITULO", $dadosAluno["TITULO"]);
            $comando->bindValue(":DESCRICAO", $dadosAluno["DESCRICAO"]);
            $comando->bindValue(":IMAGEM", $dadosAluno["IMAGEM"]);
        
            if ($comando->execute() && $comando->rowCount() > 0) return true;
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function alterar($dadosAluno): bool
    {
        try {
            $sql = "UPDATE curso SET TITULO = :TITULO, DESCRICAO = :DESCRICAO, IMAGEM = :IMAGEM
                        WHERE ID_CURSO = :ID_CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            $comando->bindValue(":ID_CURSO", $dadosAluno["ID_CURSO"]);
            $comando->bindValue(":TITULO", $dadosAluno["TITULO"]);
            $comando->bindValue(":DESCRICAO", $dadosAluno["DESCRICAO"]);
            $comando->bindValue(":IMAGEM", $dadosAluno["IMAGEM"]);

            if ($comando->execute()) return true;
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

}