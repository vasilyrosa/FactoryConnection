<?php

/* classe Tlooger
* está classe provê uma interface abstrata para definição de 
* algoritmos de Log
*/

abstract class Tlogger
{
	protected $filename; //local do arquivo de log

	/* método __construct instancia um logger */
	public function __construct($filename)
	{
		$this->filename = $filename;
		//reseta o conteúdo do arquivo
		file_put_contents($filename, '');
	}

	//define o método write() como obrigatório
	abstract function write($message);
	
}