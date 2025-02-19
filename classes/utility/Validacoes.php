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

    // método que realiza os retorno em json da API REST
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

    // deixei apenas imagem devido a necessidade da aplicação, mas o método é preparado para mais tipos
    public function validarTipoArquivo($arquivo): bool
    {
        // Lista de tipos MIME permitidos
        $tiposPermitidos = [
            // 'application/pdf',               // PDF
            // 'application/vnd.ms-excel',       // XLS
            // 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX
            // 'application/msword',             // DOC
            // 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX
            // 'text/plain',                     // TXT
            'image/png',                      // PNG
            'image/jpeg',                     // JPEG, JPG
            'image/pjpeg',                    // JPG/JFIF
            'image/webp',                     // WEBP
        ];

        $tipoArquivo = mime_content_type($arquivo['tmp_name']);

        return in_array($tipoArquivo, $tiposPermitidos, true);
    }

    public function validarTamanhoArquivo($arquivo): bool
    {
        // Tamanho máximo permitido em bytes (8MB = 8 * 1024 * 1024)
        $tamanhoMaximo = 8 * 1024 * 1024;

        return $arquivo['size'] <= $tamanhoMaximo;
    }

    // remove os caracteres que podem executar um sql injeciton
    public function removeCaracteresPerigosos(string $campo): string
    {
        $campo = preg_replace("/[#!*=+\\/\\-\\;<>?]/", "", $campo);
        return $campo;
    }
}
