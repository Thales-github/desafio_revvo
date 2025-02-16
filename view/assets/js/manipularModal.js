
/**
 * Função para manipular a abertura ou fechamento do modal.
 * @param {string} idDoModal - ID do modal (sem o "#").
 * @param {string} abrirOuFechar - 'show' para abrir o modal, 'hide' para fechar.
 */
function manipularModal(idDoModal, abrirOuFechar) {

    // Cria a instância do modal usando o ID fornecido
    let modal = new bootstrap.Modal(document.querySelector(`#${idDoModal}`));

    if (abrirOuFechar === "show") {
        modal.show(); // Abre o modal
    } else {
        modal.hide(); // Fecha o modal
    }
}