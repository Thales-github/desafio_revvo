<?php

$pasta = $_SERVER["DOCUMENT_ROOT"] . "/desafio-revvo/";
require_once($pasta . "classes/DAO/CursoDAO.php");

class Curso
{
    private $idCurso;
    private $titulo;
    private $descricao;
    private $imagem;
    private $erros = [];

    public function getIdCurso()
    {
        return $this->idCurso;
    }

    public function setIdCurso($idCurso)
    {

        if (
            !isset($idCurso) ||
            !is_numeric($idCurso) ||
            $idCurso <= 0
        ) {
            $this->setErros("O CAMPO ID_CURSO NÃO FOI INFORMADO CORRETAMENTE");
            return false;
        }
        $this->idCurso = $idCurso;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo(mixed $titulo)
    {
        $this->titulo = $titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao(mixed $descricao)
    {
        $this->descricao = $descricao;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem(mixed $imagem)
    {
        $this->imagem = $imagem;
    }

    public function getValidacoes()
    {
        return new Validacoes();
    }

    public function getErros(): array
    {
        return $this->erros;
    }

    public function setErros(mixed $erro)
    {
        array_push($this->erros, $erro);
    }

    public function instanciarCurso($parametros, $obrigaId = false)
    {
        $camposNecessarios = [
            "TITULO",
            "DESCRICAO",
            "ARQUIVO",
        ];

        if ($obrigaId) $camposNecessarios[] = "ID_CURSO";

        foreach ($camposNecessarios as $key => $value) {

            if (!isset($parametros[$value])) {
                $this->setErros("INFORME UM " . $value);
            }
        }

        foreach ($parametros as $chave => $valor) {

            if ($chave == "ARQUIVO") {
            
                $this->setImagem($valor);
            }else{

                $metodoSet = 'set' . str_replace('_', '', ucwords(strtolower($chave), '_'));
                if (!method_exists($this, $metodoSet)) {
                    continue;
                }
                $this->$metodoSet($valor);
            }

        }
    }

    public function dadosDoCurso(): array
    {
        $vetor = [
            "TITULO" => $this->getTitulo(),
            "DESCRICAO" => $this->getDescricao(),
            "NOME_ARQUIVO" => explode(".",$this->getImagem()["name"])[0],
            "TAMANHO_ARQUIVO" => $this->getImagem()["size"],
            "TIPO_ARQUIVO" => $this->getImagem()["type"],
            "ARQUIVO" => file_get_contents($this->getImagem()["tmp_name"]),
        ];

        if (is_numeric($this->getIdCurso())) {
            $vetor["ID_CURSO"] = $this->getIdCurso();
        }
        return $vetor;
    }

    public function cadastrar($parametros)
    {
        $this->instanciarCurso($parametros);
        if (!empty($this->getErros())) return $this->getValidacoes()->gerarRetornoHttp(400, $this->getErros(), []);

        $dadosCadastro = $this->dadosDoCurso();

        $cursoDAO = new CursoDAO();

        // var_dump($dadosCadastro);
        // die();
        $retorno = $cursoDAO->cadastrar($dadosCadastro);

        if ($retorno == false) return $this->getValidacoes()->gerarRetornoHttp(500, ["Erro ao cadastrar curso"], []);

        return $this->getValidacoes()->gerarRetornoHttp(201, ["Sucesso ao cadastrar novo curso"], []);
    }

    public function listar($parametros)
    {

        $cursoDAO = new CursoDAO();
        $retorno = $cursoDAO->listar();
        if ($retorno == false) $retorno = [];

        $retorno = $this->getValidacoes()->gerarRetornoHttp(200, [], $retorno);
        return $retorno;
    }

    public function detalhar($parametros)
    {
        if (
            !isset($parametros["ID_CURSO"]) ||
            !is_numeric($parametros["ID_CURSO"]) ||
            $parametros["ID_CURSO"] <= 0
        ) {
            return $this->getValidacoes()->gerarRetornoHttp(400, ["INFORME UM ID_CURSO VÁLIDO"], []);
        }

        $cursoDAO = new CursoDAO();
        $retorno = $cursoDAO->detalhar($parametros["ID_CURSO"]);
        if ($retorno == false) $retorno = [];

        $retorno = $this->getValidacoes()->gerarRetornoHttp(200, [], $retorno);
        return $retorno;
    }

    public function alterar($parametros)
    {
        $this->instanciarCurso($parametros, true);
        if (!empty($this->getErros())) return $this->getValidacoes()->gerarRetornoHttp(400, $this->getErros(), []);

        $cursoDAO = new CursoDAO();
        $cursoExiste = $cursoDAO->detalhar($this->getIdCurso());

        if (!$cursoExiste || empty($cursoExiste)) {
            return $this->getValidacoes()->gerarRetornoHttp(400, ["Curso informado não existe"], []);
        }

        $retorno = $cursoDAO->alterar($this->dadosDoCurso());

        if ($retorno === false) return $this->getValidacoes()->gerarRetornoHttp(500, ["Erro ao alterar  dados do curso"], []);

        return $this->getValidacoes()->gerarRetornoHttp(200, ["Sucesso ao alterar dados do curso"], []);
    }
}
