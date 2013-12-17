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
	//abre uma transasão
	TTransaction::open('my_livro');
	//cria instrução de INSERT
	@$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui os valores a cada coluna
	$sql->setRowData('codigo', 8);
	$sql->setRowData('nome', 'Galileu');

	//obtém a conexão ativa
	$conn = TTransaction::get();
	//executa a instrução SQL
	$result = $conn->query($sql->getInstruction());

	/* cria uma instrução de UPDATE */
	$sql = new TSqlUpdate;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui valores a tabela
	$sql->setRowData('nome', 'Galileu Galilei');

	/* cria critério de seleção de dados */
	$criteria = new Tcriteria;
	//obtém a pessoa do código 8
	$criteria->add(new Tfilter('codigo', ' = ', '8'));

	//atribui o criério de seleção de dados
	$sql->setCriteria($criteria);

	//obtem a conexão ativa
	$conn = TTransaction::get();
	//executa a instrução sql
	$result = $conn->query($sql->getInstruction());

	//fecha a transação. aplicando todas as operações
	TTransaction::close();
	
} catch (Exception $e) {
	//exibe a menssagem de erro
	echo $e->getMessage();
	//desafaz operações realizaas durante a transação
	TTransaction::rollback();
}
?>