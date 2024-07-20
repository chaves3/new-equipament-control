<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Empréstimos de Equipamentos">
	  <meta name="Keywords" content="eletrônica, equipamento, calibração, empréstimos">
	  <meta name="author" content="CHAVES TI">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_FULL; ?>css/style.css">
    <link rel="icon" href="<?php echo INCLUDE_PATH_FULL; ?>images/favicon-16x16.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Logado</title>
</head>
<body>




<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a id="link0" class="navbar-brand corLaranja" href="<?php echo INCLUDE_PATH.'logado'; ?>">Controle de Equipamentos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a id="link1" class="nav-link  corLaranja" aria-current="page" href="<?php echo INCLUDE_PATH.'emprestimo'; ?>">Empréstimos</a>
        </li>
        <li class="nav-item">
          <a id="link2" class="nav-link  corLaranja" href="<?php echo INCLUDE_PATH.'calibracao'; ?>">Calibração</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a class="logout"  href="?sair">Sair</a>
      </span>
    </div>
  </div>
</nav>
</header>
