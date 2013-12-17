<?php

/* Classe TSqlSelect
	classe provê meios para manipulação de instrução SELECT
	no banco de dados (maior comlexidade)
 */

final class TSqlSelect extends TSqlInstruction
{
	private $columns; //array de colunas a serem retornadas

	/* 
      método addColumn()
      adiciona uma coluna a ser retornada pelo SELECT
      $column = coluna da tabela
	 */
	public function addColumn($column)
	{
		//adiciona coluna em um array
		$this->columns[] = $column;
	}

	/* metodo getInstruction()
      retorna a instrução de SELECT em forma de string
	 */

      public function getInstruction()
      {
      	//monta a instrução SELECT
      	$this->sql = 'SELECT ';
      	//monta string com os nomes de colunas
      	$this->sql .= implode(', ', $this->columns);
      	//adiciona a cláusula FROM o nome da tabela
      	$this->sql .= ' FROM '.$this->entity;

      	//obtém a cláusula WHERE do objeto criteria

      	if($this->criteria)
      	{
      		$expression = $this->criteria->dump();
      		if($expression)
      		{
      			$this->sql .= ' WHERE '.$expression;
      		}
      		//obtém as propriedades do criterio
      		$order = $this->criteria->getProperty('order');
      		$limit = $this->criteria->getProperty('limit');
      		$ofset = $this->criteria->getProperty('offset');

      		//obtem a ordenação do select
      		if($order)
      		{
      			$this->sql .= ' ORDER BY '.$order;
      		}
      		if($limit)
      		{
      			$this->sql .= ' LIMIT '.$limit;
      		}
      		if($offset)
      		{
      			$this->sql .= ' OFFSET '.$offset;
      		}
      	}
      	  return $this->sql;
      }
	
}