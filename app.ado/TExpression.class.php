<?php

/* classe abstrata TExpression  para gerenciar expressões
*  Livro = pablo Daglio exemplo da pag 173 
*  @everton Rosa
*/

abstract class TExpression
{
	/* operadores lógicos */
	const AND_OPERATOR = 'AND ';
	const OR_OPERATOR  = 'OR ';

	/* Defini o método dump como obrigatório */
	abstract public function dump(); //método abstrato termina com ;
}