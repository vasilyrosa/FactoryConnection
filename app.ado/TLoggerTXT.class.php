<?php

/* classe TLoggerTXT implementa o algoritmo de LOG TXT */

class TLoggerTXT extends TLogger
{
	/* método write()
     escreve uma menssagem em um arquivo log
	 */

	 public function write($message)
	 {
	 	$time = date("Y-m-d H:i:s");
	 	//cria a string
	 	$text = "$time :: $message<br />";
	 	//adiciona ao final doa rquivo
	 	$handler = fopen($this->filename, 'a');
	 	fwrite($handler, $text);
	 	fclose($handler);
	 }
	
}