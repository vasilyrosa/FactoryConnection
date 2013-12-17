<?php
/* Classe TConnection */
/* Gerencia conexões com banco de dados através de arquivos de configuração */

final class TConnection
{
	/* método __construct()
       não existirão instâncias de TConnection, potanto o método será private
     */

    private function __construct(){}
  
  /* método open()
   recebe o nome do banco de dados e intância do objeto PDO
   */
  public static function open($name)
  {
  	//verifica se existe arquivo deconfiguração para este banco de dados
  	if(file_exists("app.config/{$name}.ini"))
  	{
  		//lê o ini e retorna um array
  		$db = parse_ini_file("app.config/{$name}.ini");

  	}
  	else
  	{
  		//caso não existir emitir erro
  		throw new Exception("Arquivo $name não encontrado");
  	}

  	//lê as informações contidas no arquivo
  	$user   = $db['user'];
  	$pass   = $db['pass'];
  	$name   = $db['name'];
  	$host   = $db['host'];
  	$type   = $db['type'];

  	//descobe qual tipo de banco de dados
  	switch($type)
  	{
  		case 'pgsql':
  		$conn = new PDO("pgsql:dbname={$name};user={$user}; password={$pass};host=$host");
  		break;
  		case 'mysql':
  		$conn = new PDO("mysql:host={$host}; dbname={$name}", $user, $pass);
  		//$conn = new PDO('mysql:host=localhost;dbname=livro', 'root','');
  		break;
  		case 'sqlite':
  		$conn = new PDO("sqlite:{$name}");
  		break;
  	}
  	//define para que o PDO lance exeções na ocorrência de erros
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	//retorna o objeto instanciado
  	return $conn;
  }
	
}