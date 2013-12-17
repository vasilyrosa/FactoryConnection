<?php

if(file_exists("../app.config/my_livro.ini"))
  	{
  		//lê o ini e retorna um array
  		$db = parse_ini_file("../app.config/my_livro.ini");
  		echo 'arquivo encontrado';
  	}
  	else
  	{
  		echo 'Erro ao encontrar arquivo';
  	}


var_dump($db);

?>