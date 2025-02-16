
async function cadastrarCurso() {

    try {

        formData = new FormData();
        formData.append("TITULO", document.querySelector("#").value);
        formData.append("DESCRICAO", document.querySelector("#").value);
        formData.append("ARQUIVO", document.querySelector("#").files[0]);

        cadastrarCurso = fetch("http://localhost/desafio-revvo/Curso/cadastrar",
            {
                method: "POST",
                body: formData
            }
        );

        let respostaApi = await resposta.json();
        let tipoMensagem = "success";
        let titulo = "Sucesso";

        if (!resposta.ok) {// http 200 até 299
            tipoMensagem = "error";
            titulo = "Erro";
        }

        Swal.fire({
            title: titulo,
            text: varrerMensagensApi(respostaApi),
            icon: tipoMensagem
        });
        return respostaApi; // Retorna os dados se precisar usar depois

    } catch (error) {
        Swal.fire({
            title: "Erro",
            text: "Não foi possível realizar a operação",
            icon: "error"
        });
        return false;
    }
}

function criarCardDeCurso() {

    let botaoCadastrarCurso = `
            <div id="btnAbrirModalCurso" class="col-md-4">
                <div class="card d-flex flex-column justify-content-center align-items-center border border-secondary rounded" style="height: 100%;">
                    <i class="bi bi-plus-circle fs-1 text-muted"></i>
                    <span class="text-muted mt-2">ADICIONAR CURSO</span>
                </div>
            </div>
    `;

    document.querySelector(".containerCursos").insertAdjacentHTML("afterbegin", botaoCadastrarCurso);
}

criarCardDeCurso();
document.querySelector("#btnAbrirModalCurso").addEventListener("click", (event) => {

    event.preventDefault();
    manipularModal("modalCadastrarCurso", "show");  // Use o ID do modal, não do botão

});
