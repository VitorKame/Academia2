<?php
namespace Models; // agrupamento de classes (caminho)

// Classe (ou Tipo) de Objeto
// obs.: Pessoa implementa a interface Idados, significando que implementa todos os métodos definidos pela interface.
class Plano implements Idados{
	// Propriedades
	protected $id_plano;
	protected $nm_plano;
	protected $vl_plano;
	// obs.: propriedades protected são acessíveis por subclasses (extend)

	// Método construtor.
	public function __construct($id_plano,$nm_plano,$vl_plano){
		$this->id_plano=$id_plano;
		$this->nm_plano=$nm_plano;
		$this->vl_plano=$vl_plano;
	}

	// Método obrigatório pois é definido na interface
	public function toString(){
		return $this->id_plano.' '.$this->nm_plano.' '.$this->vl_plano;
	}

	// Método obrigatório pois é definido na interface
	public function toJson() {
		return json_encode($this->toArray());
	}

	// Métodos estáticos (static) são chamados sem instanciar objetos. Utiliza-se o nome da classe seguido de quatro pontos. Exemplo a seguir.
	// $jp = Pessoa::toJsonEstatico(20,'Maria','2222');
	public function toArray () {
		return ['id'=>$this->ID,'nome'=>$this->NOME,'detalhe'=>$this->NUM_VIAGEM];
	}

	// Inclui o conteúdo do Trait
	use trait__get;
}