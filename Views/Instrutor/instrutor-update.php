<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
	<?php include '..\cabecalho.php'; ?>
	<form id="form1">
		<div class="form-group">
			<p>id: <input type="number" id="id_instrutor" name="id_instrutor" required maxlength="10" class="form-control" ></p>
			<p>Nome: <input type="text" name="nm_instrutor" required maxlength="100" class="form-control"></p>
			<p>Valor: <input type="text" name="nm_especialidade" required maxlength="100" class="form-control"></p>
			<p>
				<select class="custom-select justify-content-end" id="id_modalidade" name="forma" onchange="this.value;">
					<option value="">Importa Dados</option>
					<option value="/academia/Views/Plano/planoImportaDados.php">Importa Dados Plano</option>
					<option value="/academia/Views/Aluno/alunoImportaDados.php">Importa Dados Aluno</option>
					<option value="/academia/Views/Modalidade/modalidadeImportaDados.php">Importa Dados Modalidade</option>
					<option value="/academia/Views/Instrutor/instrutorImportaDados.php">Importa Dados Instrutor</option>
				</select>
			</p>
		</div>
	</form>
	<h3 id="result"></h3>
	<?php include '..\rodape.php'; ?>
</body>

</html>
<script type="text/javascript">
	id_instrutor.value = window.location.href.split('=').pop();
	form1.onsubmit = async function(e) {
		e.preventDefault();
		var json = {
			nm_instrutor: form1.nm_instrutor.value,
			nm_especialidade: form1.nm_especialidade.value,
			id_modalidade: form1.id_modalidade.value,
			id_instrutor: form1.id_instrutor.value
		};
		var resposta = await fetch('/Academia/Dao/InstrutorDao.php', {
			method: 'PUT',
			body: JSON.stringify(json)
		});
		if (resposta.ok) {
			result.textContent = "Alterado";
		} else {
			result.textContent = "Falhou";
		}
	}
</script>