
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
        let tipoMensagem = resposta.ok ? "success" : "error";
        let titulo = resposta.ok ? "Sucesso" : "Erro";

        Swal.fire({
            title: titulo,
            text: varrerMensagensApi(respostaApi),
            icon: tipoMensagem
        });

        manipularModal(`modalCadastrarCurso`, `hide`);

        criarCardDeCurso();
        criarEventosBaseDeCurso();

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

async function alterarCurso() {

    try {

        let formData = new FormData();
        formData.append("ID_CURSO", Number(sessionStorage.getItem(`codigoCurso`)));
        formData.append("TITULO", document.querySelector("#txtTituloCurso").value);
        formData.append("DESCRICAO", document.querySelector("#txtDescricaoCurso").value);
        formData.append("ARQUIVO", document.querySelector("#txtArquivoCurso").files[0]);

        let resposta = await fetch("/desafio-revvo/Curso/alterar", {
            method: "POST",
            body: formData
        });

        let respostaApi = await resposta.json(); // Agora está esperando a resposta corretamente
        let tipoMensagem = resposta.ok ? "success" : "error";
        let titulo = resposta.ok ? "Sucesso" : "Erro";

        Swal.fire({
            title: titulo,
            text: varrerMensagensApi(respostaApi),
            icon: tipoMensagem
        });

        manipularModal(`modalCadastrarCurso`, `hide`);

        criarCardDeCurso();
        criarEventosBaseDeCurso();

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

async function apagarCurso() {
    try {

        let formData = new FormData();
        formData.append("ID_CURSO", Number(sessionStorage.getItem(`codigoCurso`)));
        
        let resposta = await fetch("/desafio-revvo/Curso/apagar", {
            method: "POST",
            body: formData
        });

        let respostaApi = await resposta.json(); // Agora está esperando a resposta corretamente
        let tipoMensagem = resposta.ok ? "success" : "error";
        let titulo = resposta.ok ? "Sucesso" : "Erro";

        Swal.fire({
            title: titulo,
            text: varrerMensagensApi(respostaApi),
            icon: tipoMensagem
        });

        manipularModal(`modalCadastrarCurso`, `hide`);

        criarCardDeCurso();
        criarEventosBaseDeCurso();

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

function criarClickDetalharCurso() {

    document.querySelectorAll(".btnDetalharCurso").forEach(botao => {

        botao.addEventListener("click", (event) => {

            event.preventDefault();

            document.querySelector(`#modalCadastrarCurso #tituloDoModal`).textContent = `Alterar Curso`;
            limparFormulario(`modalCadastrarCurso`);
            manipularModal("modalCadastrarCurso", "show");

            let card = botao.parentElement.parentElement.parentElement;

            detalharCurso(card.dataset.idCurso).then((dadosDoCurso) => {

                document.querySelector(`#txtTituloCurso`).value = dadosDoCurso.dados.TITULO;
                document.querySelector(`#txtDescricaoCurso`).value = dadosDoCurso.dados.DESCRICAO;
                sessionStorage.setItem(`codigoCurso`, card.dataset.idCurso);

            });
        });
    });
}

function criarEventosBaseDeCurso() {

    document.querySelector("#btnAbrirModalCurso").addEventListener("click", (event) => {

        event.preventDefault();

        document.querySelector(`#modalCadastrarCurso #tituloDoModal`).textContent = `Cadastrar Curso`;
        limparFormulario(`modalCadastrarCurso`);
        manipularModal("modalCadastrarCurso", "show");
    });
}

function criarCardDeCurso() {

    let baseParaCardDeCurso = `
        <div class="itemCurso col-md-4" data-id-curso="ID_CURSO">
            <div class="card cardCurso">
                <img src="BASE64" class="card-img-top" alt="Curso">
                <div class="card-body">
                    <h5 class="card-title">TITULO</h5>
                    <p class="card-text">DESCRICAO</p>
                    <button class="btnDetalharCurso btn btn-success">VER CURSO</button>
                </div>
            </div>
        </div>`;

    let botaoCadastrarCurso = `
            <div style="cursor: pointer;" id="btnAbrirModalCurso" class="col-md-4">
                <div class="card d-flex flex-column justify-content-center align-items-center border border-secondary rounded" style="height: 100%;">
                    <i class="bi bi-plus-circle fs-1 text-muted"></i>
                    <span class="text-muted mt-2">ADICIONAR CURSO</span>
                </div>
            </div>
    `;

    document.querySelector(".containerCursos").insertAdjacentHTML("afterbegin", botaoCadastrarCurso);
    criarEventosBaseDeCurso();

    listarCurso().then((listaDeCursos) => {
        document.querySelector(".containerCursos").innerHTML = "";

        document.querySelector(".containerCursos").insertAdjacentHTML("afterbegin", botaoCadastrarCurso);
        criarEventosBaseDeCurso();

        listaDeCursos.dados.forEach(registro => {

            let cardCopia = baseParaCardDeCurso;
            cardCopia = cardCopia.replace("ID_CURSO", `${registro.ID_CURSO}`);
            cardCopia = cardCopia.replace("TITULO", registro.TITULO);
            cardCopia = cardCopia.replace("DESCRICAO", registro.DESCRICAO);
            cardCopia = cardCopia.replace("BASE64", `data:${registro.TIPO};base64,${registro.ARQUIVO}`);

            document.querySelector(".containerCursos").insertAdjacentHTML("afterbegin", cardCopia);

        });

        criarClickDetalharCurso();

    }).catch(erro => {
        return false;
    });

}
criarCardDeCurso();

document.querySelector("#btnSalvarCurso").addEventListener("click", (event) => {

    event.preventDefault();

    let tituloModal = document
        .querySelector(`#modalCadastrarCurso #tituloDoModal`)
        .textContent == `Cadastrar Curso`;

    if (tituloModal) {
        cadastrarCurso();
    } else {
        alterarCurso();
    }
});

document.querySelector("#btnApagarCurso").addEventListener("click", (event) => {

    event.preventDefault();

    apagarCurso();
});

criarEventosBaseDeCurso();