<?php

class Validacoes
{

    public function verificaTamanhoMinimoDeCampo(int $tamanhoMinimo, int $tamanhoMaximo, string $campo): bool
    {

        if (
            !isset($campo) ||
            !is_string($campo) ||
            strlen($campo) < $tamanhoMinimo ||
            strlen($campo) > $tamanhoMaximo
        ) {
            return false;
        }

        return true;
    }

    public function gerarRetornoHttp(int $codigoHtpp, array $mensagemRetorno, array $dadosRetorno): string
    {
        http_response_code($codigoHtpp);
        $resultado = (object)[
            "codigo" => $codigoHtpp,
            "mensagem" => $mensagemRetorno,
            "dados" => $dadosRetorno,
        ];
        return json_encode($resultado);
    }
}
