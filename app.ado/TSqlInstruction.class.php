<?php

/**
* classe TSqlInstruction
*  está classe provê os métodos comum entre todas instruções
*  sql(SELECT , INSERT, DELETE e UPDAATE)
**/

abstract class TSqlInstruction
{
	protected $sql;   //armazena a instrução sql
	protected $criteria;  //armazena o objeto critéria

	/* método setEntity()
	* define o nome da entidade (tabela) manipulada pela instrução sql
	* $entity = tabela
    */
	
	final public function setEntity($entity)
	{
		$this->entity = $entity;
	}

	/* método getEntity() retorna o nome da entidade da tabela */

	final public function getEntity($entity)
	{
		return $this->entity;
	}

	/**
	* método setCriteria() define um critério dos dados através
	* da composição de um objeto
	* $criteria = objeto do tipo TCriteria
	**/

	public function setCriteria(TCriteria $criteria)
	{
		$this->criteria = $criteria;
	}

	/**
	* método getInstruction()
	* decalrado como abstract obrigamos sua declaração nas classes filhas
	* uma vez que seu comportamento será distinto em cada uma delas, configurando o polimorfismo
	**/
	 abstract function getInstruction();
	
	
}//end_class