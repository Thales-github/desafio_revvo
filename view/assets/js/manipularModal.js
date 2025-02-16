/**
 * Função para manipular a abertura ou fechamento do modal.
 * @param {string} idDoModal - ID do modal (sem o "#").
 * @param {string} abrirOuFechar - 'show' para abrir o modal, 'hide' para fechar.
 */
function manipularModal(idDoModal, abrirOuFechar) {
    let modalElemento = document.querySelector(`#${idDoModal}`);
    let modalInstancia = bootstrap.Modal.getInstance(modalElemento) || new bootstrap.Modal(modalElemento);

    if (abrirOuFechar === "show") {
        modalInstancia.show();
    } else {
        modalInstancia.hide();
    }
}
