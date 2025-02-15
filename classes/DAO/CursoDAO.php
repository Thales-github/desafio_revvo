<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/bd/conexao.php");
require_once($pasta . "classes/DAO/AnexoCursoDAO.php");

class CursoDAO extends Conexao
{

    public function cadastrar(array $dadosCurso): bool
    {
        try {
            $conexao = Conexao::getInstance();
            $conexao->beginTransaction();

            // Inserir o curso
            $sqlCurso = "INSERT INTO curso (TITULO, DESCRICAO) VALUES (:TITULO, :DESCRICAO)";
            $comandoCurso = $conexao->prepare($sqlCurso);
            $comandoCurso->bindValue(":TITULO", $dadosCurso["TITULO"]);
            $comandoCurso->bindValue(":DESCRICAO", $dadosCurso["DESCRICAO"]);

            if (!$comandoCurso->execute()) {
                $conexao->rollBack();
                return false;
            }

            $codigoCurso = $conexao->lastInsertId();
            $anexoDAO = new AnexoCursoDAO();
            $dadosCurso["ID_CURSO"] = $codigoCurso;

            if (!$anexoDAO->cadastrar($dadosCurso)) {
                $conexao->rollBack();
                return false;
            }

            $conexao->commit();
            return true;
        } catch (Exception $e) {
            $conexao->rollBack();
            return false;
        }
    }

    public function alterar(array $dadosCurso): bool
    {
        try {
            $conexao = Conexao::getInstance();
            $conexao->beginTransaction();

            $comando = "UPDATE curso SET TITULO = :TITULO, DESCRICAO = :DESCRICAO
                            WHERE ID_CURSO = :ID_CURSO";
            $comando = $conexao->prepare($comando);
            $comando->bindValue(":ID_CURSO", $dadosCurso["ID_CURSO"]);
            $comando->bindValue(":TITULO", $dadosCurso["TITULO"]);
            $comando->bindValue(":DESCRICAO", $dadosCurso["DESCRICAO"]);

            if (!$comando->execute()) {
                $conexao->rollBack();
                return false;
            }

            // Atualizar anexo
            $anexoDAO = new AnexoCursoDAO();
            if (!$anexoDAO->alterar($dadosCurso)) {
                $conexao->rollBack();
                return false;
            }

            $conexao->commit(); // Confirma a transação
            return true;
        } catch (Exception $e) {
            $conexao->rollBack();
            return false;
        }
    }

    public function detalhar(int $idCurso): array|bool
    {
        try {
            $sql = "SELECT c.ID_CURSO, c.TITULO ,c.DESCRICAO,
                    ac.NOME, ac.TIPO, ac.TAMANHO, ac.ARQUIVO,
                    DATE_FORMAT(c.DATA_CADASTRO, '%d/%m/%Y') AS DATA_CADASTRO
                        FROM curso c
                            INNER JOIN anexo_curso ac ON c.ID_CURSO = ac.ID_CURSO
                                WHERE c.ID_CURSO = :ID_CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);

            $comando->bindValue(":ID_CURSO", $idCurso);
            $comando->execute();

            return $comando->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function listar(): array|bool
    {
        try {
            $sql = "SELECT c.ID_CURSO, c.TITULO ,c.DESCRICAO,
                    ac.NOME, ac.TIPO, ac.TAMANHO, ac.ARQUIVO,
                    DATE_FORMAT(c.DATA_CADASTRO, '%d/%m/%Y') AS DATA_CADASTRO
                        FROM curso c
                            INNER JOIN anexo_curso ac ON c.ID_CURSO = ac.ID_CURSO";

            $conexao = Conexao::getInstance();
            $comando = $conexao->prepare($sql);
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}
