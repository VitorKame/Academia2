<?php

namespace Dao;

use \PDO;
use \PDOException;
use \ReflectionClass;

include('ConfiguracaoConexao.php');


class Persiste{

	public static function Add(Object $obj){
		
		try {
			// Cria objeto PDO
			$pdo = new PDO(hostDb,usuario,senha);

			// Configura o comportamento no caso de erros: levanta exceção.
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Não emula comandos preparados, usa nativo do driver do banco
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// ReflectionClass usada para inspecionar o objeto
			// obtendo sua classe, propriedades, métodos, constantes, etc.
			$rf = new ReflectionClass($obj);

			// Obtém o nome da classe e define o nome da tabela como sendo
			// o nome da classe no plural em minúsculas
			$aux = explode("\\",$rf->name);
			$tabela = array_pop($aux);
			$tabela = strtolower($tabela.'s');

			// Gera lista de colunas, lista de parâmetros e vetor com os dados
			// para preparar o comando e executá-lo.
			$colunas = "";
			$parametros = "";
			$vetor = [];
			$primeiro = true;
			foreach($rf->getProperties() as $p)
			{
				if ($primeiro) {$primeiro=false; continue;}  // descarta o id
				$colunas = $colunas.$p->name.',';
				$parametros = $parametros.':'.$p->name.',';
				$vetor[$p->name]= $obj->{'get'.$p->name};
			}
			$colunas = substr($colunas,0,-1);   // retira última virgula
			$parametros = substr($parametros,0,-1);

			// Prepara o comando SQL
			$stmt = $pdo->prepare("insert into $tabela ($colunas) values ($parametros)");

			// Executa comando SQL
			$stmt->execute($vetor);

			$retorno = true;

		//Desvia para catch no caso de erros.	
		} catch (PDOException $pex) {
			//poder ser usado "$pex->getMessage();" ou "$pex->getCode();" para se obter detalhes sobre o erro.
			$retorno = false;

		// Sempre executa o bloco finally, tendo ocorrido ou não erros no bloco TRY	
		} finally {
			$pdo=null;
		}

		return $retorno;
	}

	// Obtém todos os objetos do banco de dados
	// Parâmetro: nome da classe dos objetos
	public static function GetAll($nomeclasse) //($inicioPagina,$tamanhoPagina)
	{
		try {
			// Cria objeto PDO
			$pdo = new PDO(hostDb,usuario,senha);

			// Configura o comportamento no caso de erros: levanta exceção.
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Não emula comandos preparados, usa nativo do driver do banco
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// ReflectionClass usada para inspecionar a classe
			// obtendo suas propriedades, métodos, constantes, etc.
			$rf = new ReflectionClass($nomeclasse);

			// Nome da tabela é igual ao nome da classe no plural minúsculas
			$aux = explode("\\",$nomeclasse);
			$tabela = array_pop($aux);
			$tabela = strtolower($tabela.'s');

			// Gera lista de colunas, lista de parâmetros e vetor com os dados
			// para preparar o comando e executá-lo.
			$colunas = "";
			foreach($rf->getProperties() as $p)
			{
				$colunas = $colunas.$p->name.',';
			}
			$colunas = substr($colunas,0,-1);   // retira última virgula

			$stmt = $pdo->prepare("select $colunas from $tabela order by id");

			// Executa comando SQL
			$stmt->execute();

			// Resultado na forma de vetor associativo
			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$retorno = []; // vetor vazio
			$linha = $stmt->fetch();
			while ($linha != null)
			{
				$obj = $rf->newInstanceWithoutConstructor();
				foreach($linha as $i=>$v)
				{
					$obj->{'set'.$i} = $v;
				}
				array_push($retorno,$obj);
				$linha = $stmt->fetch();
			}

		// Desvia para catch no caso de erros.	
		} catch (PDOException $pex) {
			//poder ser usado "$pex->getMessage();" ou "$pex->getCode();" para se obter detalhes sobre o erro.
			$retorno = null;

		// Sempre executa o bloco finally, tendo ocorrido ou não erros no bloco TRY	
		} finally {
			$pdo=null;
		}

		return $retorno;
	}

	public static function GetById($nomeclasse,$id)	{
		try {
			// Cria objeto PDO
			$pdo = new PDO(hostDb,usuario,senha);

			// Configura o comportamento no caso de erros: levanta exceção.
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Não emula comandos preparados, usa nativo do driver do banco
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// ReflectionClass usada para inspecionar a classe
			// obtendo suas propriedades, métodos, constantes, etc.
			$rf = new ReflectionClass($nomeclasse);

			// Nome da tabela é igual ao nome da classe no plural minúsculas
			$aux = explode("\\",$nomeclasse);
			$tabela = array_pop($aux);
			$tabela = strtolower($tabela.'s');

			// Gera lista de colunas, lista de parâmetros e vetor com os dados
			// para preparar o comando e executá-lo.
			$colunas = "";
			foreach($rf->getProperties() as $p)
			{
				$colunas = $colunas.$p->name.',';
			}
			$colunas = substr($colunas,0,-1);   // retira última virgula

			$stmt = $pdo->prepare("select $colunas from $tabela where id=:id");

			// Executa comando SQL
			$stmt->execute([':id'=>$id]);

			// Resultado na forma de vetor associativo
			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$obj = null;
			$linha = $stmt->fetch();
			if ($linha!=null)
			{
				$obj = $rf->newInstanceWithoutConstructor();
				foreach($linha as $i=>$v)
				{
					$obj->{'set'.$i} = $v;
				}
			}

		// Desvia para catch no caso de erros.	
		} catch (PDOException $pex) {
			//poder ser usado "$pex->getMessage();" ou "$pex->getCode();" para se obter detalhes sobre o erro.
			$retorno = null;

		// Sempre executa o bloco finally, tendo ocorrido ou não erros no bloco TRY	
		} finally {
			$pdo=null;
		}

		return $obj;
	}

	public static function Update(Object $obj)
	{
		// sql: update pessoas set nome=:nnome, telefone=:ntel where id=:id


			// Cria objeto PDO
			$pdo = new PDO(hostDb,usuario,senha);

			// Configura o comportamento no caso de erros: levanta exceção.
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Não emula comandos preparados, usa nativo do driver do banco
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// ReflectionClass usada para inspecionar o objeto
			// obtendo sua classe, propriedades, métodos, constantes, etc.
			$rf = new ReflectionClass($obj);

			// Obtém o nome da classe e define o nome da tabela como sendo
			// o nome da classe no plural em minúsculas
			$aux = explode("\\",$rf->name);
			$tabela = array_pop($aux);
			$tabela = strtolower($tabela.'s');

			// Gera lista de colunas, lista de parâmetros e vetor com os dados
			// para preparar o comando e executá-lo.
			$parametros = "";
			$vetor = [];
			foreach($rf->getProperties() as $p)
			{
				if ($p->name!='ID')
				{
					$parametros = $parametros.$p->name.' = :'.$p->name.',';
				}
				$vetor[':'.$p->name]= $obj->{'get'.$p->name};
			}
			$parametros = substr($parametros,0,-1); // retira última virgula

			// Prepara o comando SQL
			$stmt = $pdo->prepare("update $tabela set $parametros where ID=:ID");
			// Executa comando SQL
			$stmt->execute($vetor);

			$retorno = true;

		$pdo = null;

		return $retorno;

	}

	public static function Delete($nomeclasse,$id)
	{
		// sql: delete from pessoa where id=:id
		try {
			// Cria objeto PDO
			$pdo = new PDO(hostDb,usuario,senha);

			// Configura o comportamento no caso de erros: levanta exceção.
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Não emula comandos preparados, usa nativo do driver do banco
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// Obtém o nome da classe e define o nome da tabela como sendo
			// o nome da classe no plural em minúsculas
			$aux = explode('\\',$nomeclasse);
			$tabela = array_pop($aux);
			$tabela = strtolower($tabela.'s');

			$stmt = $pdo->prepare("delete from $tabela where id=:id");

			// Executa comando SQL
			$stmt->execute([':id'=>$id]);

			$retorno = true;

		// Desvia para catch no caso de erros.	
		} catch (PDOException $pex) {
			//poder ser usado "$pex->getMessage();" ou "$pex->getCode();" para se obter detalhes sobre o erro.
			$retorno = false;

		// Sempre executa o bloco finally, tendo ocorrido ou não erros no bloco TRY	
		} finally {
			$pdo=null;
		}

		return $retorno;
	}


}
?>