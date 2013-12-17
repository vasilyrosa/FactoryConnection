<?php

class TSqlUpdate extends TSqlInstruction
{
	/* método setRowData()
    * atribui valores a determinadas colunas no banco de dados 
    * que serão modificadas
    * $column = coluna da tabela
    * $value = valor armazenado
	 */
	
	public function setRowData($column, $value)
	{
		//mostra o array indexado pelo nome da coluna
		if(is_string($value))
		{
			//adiciona \ em aspas
			$value = addslashes($value);

			$this->columnValues[$column] = "'$value'";
		}

		else if (is_bool($value))
		{
			//caso seja booleano
			$this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
		}

		else if (isset($value))
		{
			//caso seja outro tipo de dado
			$this->columnValues[$column] = $value;
		}
		else
		{
			//caso seja null
			$this->columnValues[$column] = "NUL";
		}
	}

	/* método getInstruction()
    * retorna a isntrução de update em forma de string
	 */
	 public function getInstruction()
	 {
	 	//mostra a string de UPDATE
	 	$this->sql = "UPDATE {$this->entity}";
	 	//mostra os pares: coluna=valor
	 	if($this->columnValues)
	 	{
	 		foreach ($this->columnValues as $column => $value) {
	 			$set[] = "{$column} = {$value}";
	 		}
	 	}
	 	$this->sql .= ' SET '.implode(', ', $set);

	 	//retorna a cláusula where do objeto $this->criteria
	 	if($this->criteria)
	 	{
	 		$this->sql .= ' WHERE '.$this->criteria->dump();
	 	}
	 	return $this->sql;
	 }
}