<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <meta charset="utf-8">

  <!-- Ajustar viewport conforme dimensões do dispositivo (smartphone, tablet, notebook, etc.) -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Referenciar as bibliotecas necessárias para usar o Bootstrap. -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
  .jumbotron {
    background-color: #ddddff;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">


    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/academia">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/academia/Views/Plano/plano-read.php">Plano</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/academia/Views/Instrutor/instrutor-read.php">Instrutor</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/academia/Views/Modalidade/modalidade-read.php">Modalidade</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/academia/Views/Aluno/aluno-read.php">Aluno</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <select class="custom-select justify-content-end" name="forma" onchange="location = this.value;">
          <option value="">Importa Dados</option>
          <option value="/academia/Views/Plano/planoImportaDados.php">Importa Dados Plano</option>
          <option value="/academia/Views/Aluno/alunoImportaDados.php">Importa Dados Aluno</option>
          <option value="/academia/Views/Modalidade/modalidadeImportaDados.php">Importa Dados Modalidade</option>
          <option value="/academia/Views/Instrutor/instrutorImportaDados.php">Importa Dados Instrutor</option>
        </select>
      </form>
    </div>
  </nav>