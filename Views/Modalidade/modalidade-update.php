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
			<p>id: <input type="number" id="id_modalidade" name="id_modalidade" required maxlength="10" class="form-control" readonly></p>
			<p>Nome: <input type="text" name="nm_modalidade" required maxlength="100" class="form-control"></p>
			<p>Valor: <input type="text" name="qt_aulas" required maxlength="100" class="form-control"></p>
			<p><input type="submit" value="Salvar" class="btn btn-primary btn-small"></p>
		</div>
	</form>
	<h3 id="result"></h3>
	<?php include '..\rodape.php'; ?>
</body>

</html>
<script type="text/javascript">
	id_modalidade.value = window.location.href.split('=').pop();
	form1.onsubmit = async function(e) {
		e.preventDefault();
		var json = {
			nm_modalidade: form1.nm_modalidade.value,
			qt_modalidade: form1.qt_aulas.value,
			id_modalidade: form1.id_modalidade.value
		};
		var resposta = await fetch('/Academia/Dao/ModalidadeDao.php', {
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