<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEO - Plataforma de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    <header class="d-flex justify-content-between align-items-center p-3 bg-light">
        <div class="logo fs-3 fw-bold">LEO</div>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Pesquisar curso...">
        </div>
        <div class="user-profile d-flex align-items-center">
            <img src="assets/img/usuario.jpg" alt="Thales Vitor" class="rounded-circle" width="40">
            <span class="ms-2">
                Seja bem-vindo
                <br>
                <strong>Thales Vitor</strong>
            </span>
        </div>
    </header>

    <section class="banner text-white text-center p-5 bg-dark">
        <h2>LOREM IPSUM</h2>
        <p>Aenean lacinia bibendum nulla sed consectetur...</p>
        <button class="btn btn-primary">VER CURSO</button>
    </section>

    <main class="containerCursos mt-4">
        <h2 class="mb-3">MEUS CURSOS</h2>
        <div class="row g-3">
            <!-- <div class="itemCurso col-md-4">
                <div class="card cardCurso">
                    <img src="assets/img/marketing.png" class="card-img-top" alt="Curso">
                    <div class="card-body">
                        <h5 class="card-title">PELLENTESQUE MALESUADA</h5>
                        <p class="card-text">Cum sociis natoque penatibus...</p>
                        <button class="btn btn-success">VER CURSO</button>
                    </div>
                </div>
            </div> -->
            
        </div>
    </main>

    <footer class="bg-light p-4 mt-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="logo fs-4 fw-bold">LEO</div>
                <p>Maecenas faucibus mollis interdum...</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>CONTATO</h4>
                <p>(21) 98765-3434</p>
                <p>contato@leolearning.com</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>REDES SOCIAIS</h4>
                <div>
                    <span class="mx-1">🔵</span>
                    <span class="mx-1">🐦</span>
                    <span class="mx-1">📌</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/manipularModal.js"></script>
    <script src="assets/js/varrerMensagensApi.js"></script>
    <script src="controller/curso/listarCurso.js"></script>
    <script src="controller/curso/acoesCurso.js"></script>
</body>

</html>