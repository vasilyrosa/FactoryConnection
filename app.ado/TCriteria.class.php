<?PHP

/*==========  classe para definição de critério  ==========*/

class TCriteria extends TExpression
{
	private $expressions; //armazena a lista de expressões
	private $operators;  //armazena a lista de operadores
	private $properties; //propriedade do critério 

/**
* método add()
* adiciona uma expressão ao critério
* @param $expression = expressão (objeto TExpression)
* @param $ooperator = operador lógico de comparação
**/
	public function add(TExpression $expression, $operator = self::AND_OPERATOR)
	{
		//na primeira vez não precisamos de operaador lógico para concatenar
		if(empty($this->expressions))
		{
			unset($operator);
		}
		//agrega o resultado da expressão á lista de expressões
		$this->expressions  [] = $expression;
		$this->operators    [] = $operator;
	}

	/* método dum() retorna a expressão final */
	public function dump()
	{
		//concatena a lista de expressões
		if(is_array($this->expressions)){
			foreach ($this->expressions as $i => $expression)
		    {
				$operator = $this->operators[$i];
				//concatena o operador com a respectiva expressão
				$result .= $operator.$expression->dump().' ';
			}
		$result = trim($result);
		return "{$result}"; //use 
		}
	}	

	/* método setProperty 
	* define o valor de uma propridade
	* $property = propriedade / $value = valor
	*/
	public function setProperty($property, $value)
	{
		$this->properties[$property] = $value;
	}
    /* método getProperty
	* retona o valor de uma propriedade.		
    */
    public function getProperty($property)
    {
    	return $this->properties[$property];
    }
	 
}