<?php

/* função autoload */

function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//cria a instrução de SELECT

$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('famosos');
//acrescenta colunas à consulta
$sql->addColumn('codigo');
$sql->addColumn('nome');

//criar criterio de seleção de dados
$criteria = new TCriteria;
//obtém a pessoa de código '1'
$criteria->add(new TFilter('codigo', ' = ', '4'));

//atribui p criterio a seleção de dados
$sql->setCriteria($criteria);

try {
	//abre conexão com a base my_livro(mysql)
	$conn = TConnection::open('my_livro');

	//executa a instrução sql
	$result = $conn->prepare($sql->getInstruction());
	$result->execute();
	if($result)
	{
		$row = $result->fetch(PDO::FETCH_OBJ);
		//exibe os dados resultantes
		
		echo $row->codigo. ' - '.$row->nome. '<br />';
	}
	//close connection
	$conn = null;
} catch (PDOException $e) {
	//exibe erro
	echo 'Erro '.$e->getMessage().'<br />';
	die();
}

/*try {
	//abre conexão com a base my_livro(postgres)
	$conn = TConnection::open('pg_livro');

	//executa a instrução sql
	$result = $conn->query($sql->getInstruction());
	if($result)
	{
		$row = $result->fetch(PDO::FETCH_OBJ);
		//exibe os dados resultantes
		echo $row->codigo. ' - '.$row->nome. '<br />';
	}
	//close connection
	$conn = null;
} catch (PDOException $e) {
	//exibe erro
	echo 'Erro '.$e->getMessage().'<br />';
	die();
}*/
?>