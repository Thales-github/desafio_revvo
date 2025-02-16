async function cadastrarCurso() {
    
    try {

        formData = new FormData();
        formData.append("TITULO", document.querySelector("#").value);
        formData.append("DESCRICAO", document.querySelector("#").value);
        formData.append("ARQUIVO", document.querySelector("#").files[0]);
      
        cadastrarCurso = fetch("http://localhost/desafio-revvo/Curso/cadastrar",
            {
                method: "POST",
                body: 
            }
        );

    } catch (error) {
        return false;
    }
}