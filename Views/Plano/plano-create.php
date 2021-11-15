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
			<p>Nome: <input type="text" name="nm_plano" required maxlength="100" class="form-control"></p>
			<p>Valor: <input type="text" name="vl_plano" required maxlength="100" class="form-control"></p>
			<p><input type="submit" value="Salvar" class="btn btn-primary btn-small"></p>
		</div>
	</form>
	<h3 id="result"></h3>
	<?php include '..\rodape.php'; ?>
</body>

</html>
<script type="text/javascript">
	form1.onsubmit = async function(e) {
		e.preventDefault();
		var json = {
			nm_plano: form1.nm_plano.value,
			vl_plano: form1.vl_plano.value
		};
		var resposta = await fetch('/Academia/Dao/PlanoDao.php', {
			method: 'POST',
			body: JSON.stringify(json)
		});
		if (resposta.ok) {
			result.textContent = "Cadastrado";
		} else {
			result.textContent = "Falhou";
		}
	}
</script>