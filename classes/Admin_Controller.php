<?php 
class Admin_Controller{
	
	public function admin_insert(array $data){
			$stmt=$this->clone_con->prepare("insert into admin values(?,?,?,?,?)");
			$stmt->execute($data);
			return true;
		}
	}
?>