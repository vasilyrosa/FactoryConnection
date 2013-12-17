<?php

/* classe TLoggerXML
 implementa o algoritmo de LOG em xml
 */

class TLoggerXML extends TLogger
{

 /* método write() escreve uma menssagem noa rquivo de LOG
  $param $message = menssagem a ser escrita
  */
	public function write($message)
	{
		$time = date("Y-m-d H:i:s");
		//cria a string
		$text = "<log><br />";
		$text .= " <time>$time</time><br />";
		$text .= " <message>$message</message><br />";
		$text .= "</log><br />";

		//adiciona ao final do arquivo
		$handler = fopen($this->filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	} 
}