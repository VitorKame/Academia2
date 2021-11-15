<?php include 'header.php'; ?>

<!-- O grid deve ser incluído em container. -->
<div class="container" style="margin-top:30px">
  <!-- O grip pode ter várias linhas (row). Cada linha pode ter até 12 colunas (col). -->
  <div class="row">
    <!-- 1a coluna da linha correspondendo a 4 colunas unitárias do grid. sm para configuração do grid para visualização em dispositivos pequenos (sm = small, >= 576px). Caso o dispositivo tenha largura de tela menor que 576px, as colunas deixam de ser colunas e passam a ser empilhadas umas sobre as outras. -->
    <div class="col-sm-4">
      <h3>Links Úteis</h3>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="https://github.com/ewerton336/Controle-Containers" target="_blank">GitHub</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.php.net/manual/pt_BR/index.php" target="_blank">Manual do PHP</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>Descrição</h2>
      <p>TP de PHP - Controle de Containers</p>

      <h1> ALA OS CONTAINER KKKKKKKKKKKKKKKKKKKK VRUM VRUM NAVIO </h1>
      <img src="https://media.istockphoto.com/photos/multicolor-shipping-containers-stacked-high-at-a-port-picture-id1226882751?b=1&k=20&m=1226882751&s=170667a&w=0&h=nZR2a7yrg6JN0lLI-oylOr4EVIsDplRL-9odvdGzGPg=" alt="">
    </div>
  </div>

</div>

<?php include 'footer.php'; ?>