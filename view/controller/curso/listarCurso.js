async function listarCurso() {
    try {
        let resposta = await fetch('/desafio-revvo/Curso/listar');

        if (!resposta.ok) {// http 200 até 299
            throw new Error(`Erro HTTP! Status: ${resposta.status}`);
        }

        let cursos = await resposta.json();

        return cursos;
    } catch (error) {
        return false;
    }
}

/**
 * Detalha um curso
 * @param {int} codigoCurso 
 * @returns {boolean|object}
 */
async function detalharCurso(codigoCurso) {
    try {

        formData = new FormData();
        formData.append("ID_CURSO", codigoCurso);

        let resposta = await fetch('/desafio-revvo/Curso/detalhar',
            {
                method: "POST",
                body: formData
            }
        );

        if (!resposta.ok) {// http 200 até 299
            throw new Error(`Erro HTTP! Status: ${resposta.status}`);
        }

        let data = await resposta.json();

        return data; // Retorna os dados se precisar usar depois
    } catch (error) {
        return false; // Retorna null em caso de erro
    }
}