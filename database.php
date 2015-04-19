<?php
class Database {

	public $handler;

	private $serverName = "localhost";
	private $serverUser = "root";
	private $serverPass = "";
	private $serverDB   = "ipark";

	function Database(){
		
		try {
 
			$this->handler = new PDO("mysql:host=$this->serverName;dbname=$this->serverDB", $this->serverUser, $this->serverPass);
			$this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->handler->exec("SET NAMES UTF8");
		
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
		
	}
	
	function __destruct(){
		
		$this->handler = null;
		
	}
	
}
?>
