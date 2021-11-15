<script type="text/javascript">
	id_plano.value = window.location.href.split('=').pop();

	var r = confirm("Deseja excluir?");

	if (r == true) {
		e.preventDefault();
		var json = {
			id_plano: form1.id_plano.value
		};
		var resposta = await fetch('/Academia/Dao/PlanoDao.php', {
			method: 'DELETE',
			body: JSON.stringify(json)
		});
		if (resposta.ok) {
			result.textContent = "Deletado";
		} else {
			result.textContent = "Falhou";
		}
	} else {
		txt = "You pressed Cancel!";
	}
</script>