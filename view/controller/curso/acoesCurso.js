
async function cadastrarCurso() {
    try {
        let formData = new FormData();
        formData.append("TITULO", document.querySelector("#txtTituloCurso").value);
        formData.append("DESCRICAO", document.querySelector("#txtDescricaoCurso").value);
        formData.append("ARQUIVO", document.querySelector("#txtArquivoCurso").files[0]);

        let resposta = await fetch("/desafio-revvo/Curso/cadastrar", {
            method: "POST",
            body: formData
        });

        let respostaApi = await resposta.json(); // Agora está esperando a resposta corretamente
        let tipoMensagem = resposta.ok ? "success" : "error"; // Apenas um jeito mais limpo de verificar
        let titulo = resposta.ok ? "Sucesso" : "Erro";

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

    let baseParaCardDeCurso = `
        <div class="itemCurso col-md-4">
            <div class="card cardCurso">
                <img src="BASE64" class="card-img-top" alt="Curso">
                <div class="card-body">
                    <h5 class="card-title">PELLENTESQUE MALESUADA</h5>
                    <p class="card-text">Cum sociis natoque penatibus...</p>
                    <button class="btn btn-success">VER CURSO</button>
                </div>
            </div>
        </div>`;

    let botaoCadastrarCurso = `
            <div style="cursor: pointer" id="btnAbrirModalCurso" class="col-md-4">
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
    manipularModal("modalCadastrarCurso", "show");
});

document.querySelector("#btnSalvarCurso").addEventListener("click", (event) => {

    event.preventDefault();
    cadastrarCurso();
});