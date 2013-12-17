<?php

/* classe TTransaction provê métodos necessários para manipular transações */

final class TTransaction
{
	private static $conn;  // conexão ativa
	private static $logger; //objeto de LOG

	/* método construct private para impedir que se crie instâncias */
	private function __construct(){}

	/* método open abre uma conexão com o banco */

	public static function open($database)
	{
		//abre uma conexão e armazena na propriedade estática $conn
		if(empty(self::$conn))
		{
			self::$conn = TConnection::open($database);
			//incia a transação
			self::$conn->beginTransaction();
		}
	}
	
	/* metodo get()  retorna a conexão ativa da transação*/
	public static function get()
	{
		//retorna a conexão ativa
		return self::$conn;
	}
	
	//método rollback() desfaz todas operações realizadas na transação
	public static function rollback()
	{
		if(self::$conn)
		{
			//desfaz as operações realizadas durante a transação
			self::$conn->rollback();
			self::$conn = NULL;
		}
	}
	/* método close() aplica todas as operações realizadas e fecha a transação */
	public static function close()
	{
		if(self::$conn)
		{
			//aplica as operações realizadas
			//durante a transação
			self::$conn->commit();
			self::$conn = NULL;
		}	
	}

	/* método setLogger() define qual estratégia de log usar */
	 public static function setLogger(Tlogger $logger)
	 {
	 	self::$logger = $logger;
	 }

	 /* método log baseada na estratégia (logger) atual */
	 public static function log($message)
	 {
	 	//verifica se existe um log
	 	if(self::$logger)
	 	{
	 		self::$logger->write($message);
	 	}
	 }
	 
			
}