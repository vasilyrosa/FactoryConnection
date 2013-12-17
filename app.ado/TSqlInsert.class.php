<?php

/**
* Classe TSqlInsert
* Esta classe provê meios para manipulação de uma instrução
* INSERT no banco de dados. 
**/

final class TSqlInsert extends TSqlInstruction 
{
	/**
	* método setRowData()
	* atribui valores a determinadas colunas no banco
	* que serão inseridas $column = coluna da tabela, 
	* $value = valor a ser armazenado
	**/
	
	public function setRowData($column, $value)
	{
		//cria um array indexado com o nome da coluna
		if (is_string($value))
		{
			//adiciona aspas
			$value = addslashes($value);
			$this->columnValues[$column] = "'$value'";
		}
		else if (is_bool($value))
		{
			//caso seja boolean
			$this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
		}
		else if (isset($value))
		{
			//caso seja outo tipo de dado
			$this->columnValues[$column] = $value;
		}
		else
		{
			//caso seja NULL
			$this->columnValues[$column] = 'NULL';
		}
	}

	/**
	* método setCriteria()
	* não existe no contexto desta classe, logo irá lançar
	* um erro se for executado
	**/
	public function setCriteria($criteria)
	{
		//lança erro
		throw new Exception("Não foi possivel a instancia de ".__CLASS__ );
	}

	/**
	* método getInstruction
	* retorna a isntrução de INSERT e, forma de string
	*
	**/
	 public function getInstruction()
	 {
	 	$this->sql = "INSERT INTO {$this->entity} (";
	 		//monta uma string contendo os nomes de colunas
	 		$columns = implode(', ',array_keys($this->columnValues));
	 		//monta uma string contendo os valores
	 		$values  = implode(', ',array_values($this->columnValues));
	 		$this->sql .= $columns . ')';
			$this->sql .= " VALUES ({$values})";

			return $this->sql;
	 }
}