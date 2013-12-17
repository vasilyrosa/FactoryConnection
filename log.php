<?php

/* função __autoload() */
function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}
 try {
 	//abre uma transação
 	TTransaction::open('my_livro');
 	//define a estratégia de LOG
 	TTransaction::setLogger(new TLoggerHTML('tmp/arquivo.html'));
 	//escreve menssagem de log
 	TTransaction::log("Inserindo registro William Wallace");

 	//cria uma instrução INSERT
   @$sql = new TSqlInsert;
 	//define o nome da entidade
 	$sql->setEntity('famosos');
 	//atribui o valor a cada coluna
 	$sql->setRowData('codigo', 9);
 	$sql->setRowData('nome', 'William Wallace');

 	//conexão ativa
 	$conn = TTransaction::get();
 	//executa a instrução SQL
 	$result = $conn->query($sql->getInstruction());

 	//escreve uma menssagem de LOG
 	TTransaction::log($sql->getInstruction());

 	//////////////////////  ***   ////////////////////////
 	//define a estratégia de log XML
 	TTransaction::setLogger(new TLoggerXML('tmp/arquivo.html'));

 	//escreve a menssagem de LOG
 	TTransaction::log("Inserindo registro Albert Einsten");

 	//cria uma instrução de Insert
 	@$sql = new TSqlInsert;
 	$sql->setEntity('famosos');
 	$sql->setRowData('codigo', 10);
 	$sql->setRowData('nome', 'Albert Einsten');

 	//obtém a conexão ativa 
 	$conn = TTransaction::get();
 	//executa a instrução SQL
 	$result = $conn->query($sql->getInstruction());
 	//escreve a menssagem de log
 	TTransaction::log($sql->getInstruction());

 	//fecha transação , aplicando todas as operações
 	TTransaction::close();
 } catch (Exception $e) {
 	//exibe menssagem de erro
 	echo $e->getMessage();
 	//desfaz operações realizadas durante a transação
 	TTransaction::rollback();
 }

?>