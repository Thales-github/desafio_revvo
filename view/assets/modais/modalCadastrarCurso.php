<!-- Modal Cadastrar Curso -->
<div class="modal fade" id="modalCadastrarCurso" tabindex="-1" aria-labelledby="modalCadastrarCursoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloDoModal">Cadastrar Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCadastrarCurso">
                    <!-- Campo para o título -->
                    <div class="mb-3">
                        <label for="txtTituloCurso" class="form-label">Título do Curso</label>
                        <input type="text" class="form-control" id="txtTituloCurso" maxlength="100" required>
                    </div>

                    <!-- Campo para a descrição -->
                    <div class="mb-3">
                        <label for="txtDescricaoCurso" class="form-label">Descrição</label>
                        <textarea class="form-control" id="txtDescricaoCurso" rows="4" maxlength="500" required></textarea>
                        <small class="text-muted">Máximo de 500 caracteres</small>
                    </div>

                    <div class="mb-3">
                        <label for="txtArquivoCurso" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="txtArquivoCurso" name="arquivoCurso" accept=".png,.jpg,.jpeg" required>
                        <small class="text-muted">Formatos permitidos: PNG, JPG, JPEG</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btnSalvarCurso">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-danger" id="btnApagarCurso">Apagar</button>
            </div>
        </div>
    </div>
</div>