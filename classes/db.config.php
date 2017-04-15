<?php 
class Dbconnect{
	
	private $host="localhost",
		 $dbname="health",
		 $username="root",
		 $pwd="";
		 
		 public $con; //handler	 
	
	public function __construct(){
		try{
		$this->con=new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->pwd);
		$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}
		catch(PDOException $e){
			echo $e->getMessage();
			}		
		}

	
	public function __destruct(){
		$this->con=null;
		}
		
		
}

?>
