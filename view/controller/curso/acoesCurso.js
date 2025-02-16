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