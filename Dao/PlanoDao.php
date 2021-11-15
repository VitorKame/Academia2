<?php

	const hostDb = "mysql:host=localhost;dbname=academia";
  	const usuario = "root";
  	const senha = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{

		$pdo = new PDO(hostDb,usuario,senha);

		$cmm = $pdo->prepare('SELECT id_plano, nm_plano, vl_plano FROM plano');

		$cmm->execute();

		$alunos = $cmm->fetchAll(PDO::FETCH_ASSOC);

		http_response_code(200);

		echo json_encode($alunos);

	}
	else if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$json = file_get_contents("php://input");

		$aux = json_decode($json);  

		$pdo = new PDO(hostDb,usuario,senha);

		$cmm = $pdo->prepare('INSERT INTO plano VALUES(\'\',:pnm_plano,:pvl_plano)');

		$cmm->execute([':pnm_plano'  => $aux->nm_plano, ':pvl_plano'  => $aux->vl_plano]);

		http_response_code(201);

		echo $json;

	}
	else if ($_SERVER['REQUEST_METHOD'] == 'PUT')
	{

		$json = file_get_contents("php://input");

		$aux = json_decode($json);  

		$pdo = new PDO(hostDb,usuario,senha);

		$cmm = $pdo->prepare('UPDATE plano SET nm_plano = :pnm_plano, vl_plano = :pvl_plano WHERE id_plano = :pid_plano');

		$cmm->execute([':pnm_plano'  => $aux->nm_plano, ':pvl_plano'  => $aux->vl_plano, ':pid_plano' => $aux->id_plano ]);

		http_response_code(200);

		echo $json;

	}
	else if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		// excluir uma da tabela alunos

		$json = file_get_contents("php://input");

		// exclusão de aluno conforme os dados vindos no json
		$aux = json_decode($json);  

		$pdo = new PDO(hostDb,usuario,senha);

		$cmm = $pdo->prepare('DELETE FROM plano WHERE id_plano = :pid_plano');

		$cmm->execute([  ':pid_plano' => $aux->id_plano  ]);

		http_response_code(200);

		echo '{"resultado" : "excluído"}';
	}
?>