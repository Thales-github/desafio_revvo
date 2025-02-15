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

    public function validarTipoArquivo($arquivo): bool {
        // Lista de tipos MIME permitidos
        $tiposPermitidos = [
            'application/pdf',               // PDF
            'application/vnd.ms-excel',       // XLS
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX
            'application/msword',             // DOC
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX
            'text/plain',                     // TXT
            'image/png',                      // PNG
            'image/jpeg',                     // JPEG, JPG
            'image/pjpeg',                    // JPG/JFIF
            'image/webp',                     // WEBP
            'image/jxl',                      // JPEG XL (caso seja necessário)
        ];
    
        // Obtém o tipo real do arquivo
        $tipoArquivo = mime_content_type($arquivo['tmp_name']);
    
        // Verifica se o tipo do arquivo está na lista de permitidos
        return in_array($tipoArquivo, $tiposPermitidos, true);
    }
    
}
