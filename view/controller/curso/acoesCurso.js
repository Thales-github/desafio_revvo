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

        
        if (!resposta.ok) {// http 200 até 299
            throw new Error(`Erro HTTP! Status: ${resposta.status}`);
        }

        let data = await resposta.json();

        return data; // Retorna os dados se precisar usar depois
        

    } catch (error) {
        return false;
    }
}