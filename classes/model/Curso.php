<?php

class Curso
{
    private string $titulo;
    private string $descricao;
    private mixed $imagem;

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

    public function cadastrar(array $parametros) {
        

    }
}
