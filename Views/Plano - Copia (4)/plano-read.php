<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript">
		async function consulta() {
			let resposta = await fetch('/Academia/Dao/PlanoDao.php'); // obtém string contendo a estrutura de um vetor de alunos
			let vetorAlunos = await resposta.json(); // converte para Json  
			//console.log(vetorAlunos);
			for (let aluno of vetorAlunos) {


				const tr = document.createElement("tr");
				dados.appendChild(tr);
				for (var i = 0; i < 5; i++) {

					const td = document.createElement("td");
					const a = document.createElement("a");
					const b = document.createElement("button");
					a.className = "btn btn-primary btn-small";
					b.className = "btn btn-primary btn-small";
					switch (i) {
						case 0:
							td.textContent = aluno.id_plano;
							dados.appendChild(td);
							break;
						case 1:
							td.textContent = aluno.nm_plano;
							dados.appendChild(td);
							break;
						case 2:
							td.textContent = aluno.vl_plano;
							dados.appendChild(td);
							break;
						case 3:
							a.href = 'plano-update.php?id=' + aluno.id_plano + '';
							a.innerText = 'Editar';
							td.appendChild(a);
							dados.appendChild(td);
							break;
						case 4:
							b.innerHTML = 'Deletar';
							b.addEventListener('click', async function(e) {
								e.preventDefault();
								var r = confirm("Apagar?");
								if(r){
									var json = {
										id_plano: aluno.id_plano
									};
									var coisa = await fetch('/Academia/Dao/PlanoDao.php', {
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
		<a class="btn-primary" href="/academia/Views/Plano/plano-create.php">Incluir</a>
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