// Função para abrir o modal
/**
 * @param {string} idDoModal 
 * @param {boolean} abrirOuFechar show/hide
 */
function manipularModal(idDoModal, abrirOuFechar) {
    
    let modal = new bootstrap.Modal(document.getElementById(`${idDoModal}`));
    modal.abrirOuFechar();
}