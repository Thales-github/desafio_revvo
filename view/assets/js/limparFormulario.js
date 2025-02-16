function limparFormulario(idFormulario) {
    let formulario = document.querySelector(`#${idFormulario}`);

    if (!formulario) {
        return false;
    }

    let campos = formulario.querySelectorAll("input, select, textarea");

    campos.forEach(campo => {
        if (campo.tagName === "SELECT") {
            campo.selectedIndex = 0;
        } else if (campo.type === "checkbox") {
            campo.checked = false;
        } else if (campo.type === "text" || campo.tagName === "TEXTAREA") {
            campo.value = "";
        } else if (campo.type === "number") {
            campo.value = "1";
        } else if (campo.type === "file") {
            campo.value = "";
        }
    });
}
