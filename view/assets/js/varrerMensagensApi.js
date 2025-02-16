function varrerMensagensApi(respostaApi) {

    // Verifica se há mensagens de erro
    if (respostaApi.mensagem && respostaApi.mensagem.length > 0) {
        return respostaApi.mensagem.join('\n');  // Junta as mensagens com quebra de linha
    } else {
        return '';  // Caso não haja erros
    }
}