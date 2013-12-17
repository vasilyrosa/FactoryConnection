<?php

/* classe TSqlDelete
  Esta classe provê meios para manipulação de uma instrução
  de Delete no banco de dados
 */

final class TSqlDelete extends TSqlInstruction
{
	/* método getInsruction()
     retorna a isntrução de Delete em forma de string
	 */

	 public function getInstruction()
	 {
	 	//mostra a string delete
	 	$this->sql = "DELETE FROM {$this->entity}";

	 	//retorna a cláusula WHERE do objeto $this->criteria
	 	if($this->criteria)
	 	{
	 		$expression = $this->criteria->dump();
	 		if($expression)
	 		{
	 			$this->sql .= ' WHERE '.$expression;
	 		}
	 	}
	 	return $this->sql;
	 }
	
}