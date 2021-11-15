<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript">
		async function consulta() {
			let resposta = await fetch('/Academia/Dao/InstrutorDao.php');
			let vetorInstrutores = await resposta.json();
			
			for (let instrutor of vetorInstrutores) {


				const tr = document.createElement("tr");
				dados.appendChild(tr);
				for (var i = 0; i < 6; i++) {

					const td = document.createElement("td");
					const a = document.createElement("a");
					const b = document.createElement("button");
					a.className = "btn btn-primary btn-small";
					b.className = "btn btn-primary btn-small";
					switch (i) {
						case 0:
							td.textContent = instrutor.id_instrutor;
							dados.appendChild(td);
							break;
						case 1:
							td.textContent = instrutor.nm_instrutor;
							dados.appendChild(td);
							break;
						case 2:
							td.textContent = instrutor.nm_especialidade;
							dados.appendChild(td);
							break;
						case 3:
							td.href = 'instrutor-update.php?id=' + instrutor.instrutor + '';
							a.innerText = 'Editar';
							td.appendChild(a);
							dados.appendChild(td);
							break;
						case 4:
							td.textContent = instrutor.nm_modalidade;
							dados.appendChild(td);
							break;
						case 5:
							b.innerHTML = 'Deletar';
							b.addEventListener('click', async function(e) {
								e.preventDefault();
								var r = confirm("Apagar?");
								if(r){
									var json = {
										instrutor: instrutor.instrutor
									};
									var coisa = await fetch('/Academia/Dao/Instrutor.php', {
										method: 'DELETE',
										body: JSON.stringify(json)
									});
									if (coisa.ok) {
										refresh();
									} else {
										result.textContent = "FALHOU";
									}
								}
							});
							td.appendChild(b);
							dados.appendChild(td);
							break;
						default:
							break;
					}
				}
			}
		}

		function refresh() {
			// excluir todos os parágrafos
			while (dados.hasChildNodes()) {
				dados.removeChild(dados.childNodes[0]);
			}
			// Consultar API
			consulta();
		}

	</script>
</head>

<body onload="consulta()">
	<?php include '..\cabecalho.php'; ?>
	<h4 id="result"></h4>
	<button class="btn btn-primary btn-small">
		<a class="btn-primary" href="/academia/Views/Instrutor/instrutor-create.php">Incluir</a>
	</button>
	<button class="btn btn-primary btn-small" onclick="refresh()">Refresh</button>
	<div class="container">
	<div class="col-sm-12">
		<table class="table table-striped" style="margin-top: 5px" id="dados">

		</table>
	</div>
	</div>
	<?php include '..\rodape.php'; ?>
</body>

</html>