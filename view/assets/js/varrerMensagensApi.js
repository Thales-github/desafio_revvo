function varrerMensagensApi(respostaApi) {

    // Verifica se há mensagens de erro
    if (response.mensagem && response.mensagem.length > 0) {
        return response.mensagem.join('\n');  // Junta as mensagens com quebra de linha
    } else {
        return '';  // Caso não haja erros
    }
}