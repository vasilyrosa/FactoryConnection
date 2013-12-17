<?php

/* classe TLoggerHTML implementa o algoritmo de LOG em HTML */

class TLoggerHTML extends Tlogger
{
	/* método write() escreve uma menssagem no arquivo de LOG*/
	public function write($message)
	{
		$time = date("Y-m-d H:i:s");
		//cria a string
		$text = "<p><br />";
		$text .= " <b>$time</b> : <br />";
		$text .= " <i>$message</i> : <br />";
		$text .= "</p><br />";

		//adiciona ao final do arquivo
		$handler = fopen($this->filename, 'a+');
		fwrite($handler, $text);
		fclose($handler);
	}
}