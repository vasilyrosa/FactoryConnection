<?php

class TFilter extends TExpression
{
	private $variable; //variavél
	private $operador; //operdor
	private $value;    //valor

	/**
	* método construct instancia um novo filtro
	**/
	
	public function __construct($variable, $operator, $value)
	{
		$this->variable = $variable;
		$this->operator = $operator;
		//transforma o valor de acordo com certas regras
		//antes de atribuir a propriedade $this->valor
		$this->value    = $this->transform($value); 
	}

	/* método transform recebe um valor e faz a modificação necessária
	* para ele ser interpretado pelo banco de dados podendo ser 
	* int/string/boolean ou array
	* @param $value = valor a ser trasformado
	*/
	private function transform($value)
	{
		//caso seja um array
		if(is_array($value))
		{
			//percorre os valores
			foreach ($value as $x) {
				//se for um array de inteiro.
				if(is_integer($x))
				{
					$foo[] = $x;
				} 
				else if (is_string($x))
				{
					//se for string adiciona aspas
					$foo[] = "'$x'";
				}
			}
			//converte o array em string separada por ','
			$result = '('.implode(',', $foo).')';
		}
		else if (is_string($value))
		{
			//adiciona aspas
			$result = "'$value'";
		}
		//caso seja um valor nulo
		else if (is_null($value))
		{
			//armazena null
			$result = 'NULL';
		}
		//caso seja booleano
		else if(is_bool($value))
		{
			//armazena TRUE ou FALSE
			$result = $value? 'TRUE' : 'FALSE';
		}
		else
		{
			$result = $value;
		}
		//retorna o valor provavelmente um (integer)
		return $result;
	}//end transform
	
	public function dump()
	{
		/* concatena a expressão */
		return "{$this->variable}{$this->operator}{$this->value}";
		
	}
	
} //end class