<?php include("db.config.php");?>
<?php include ("Admin_Controller.php");?>
<?php 
session_start();
class Controller extends Admin_Controller{

	private $ncon;
	const SALT="8ef93je";
	
	//cleaner
	
	public function cleaner($data){
			return strip_tags(addslashes(trim($data)));
		}
	
	//give all power $con variable to $clone_con
	public function __construct(){
			$obj=new Dbconnect;
			$x=$obj->con;
			$this->ncon=$x;
		}
			
		
		//login process
		public function login($u,$p,$tab_name){
				$pwd=sha1(Controller::SALT.$p);
				$stmt=$this->ncon->prepare("select id from ".$tab_name." where email='".$u."' and pwd='".$pwd."'");
				$stmt->execute();
				if($stmt->rowCount()==1){
				while($row=$stmt->fetch(PDO::FETCH_OBJ)){ //object formate and arrray- assoc
					return $row->id;
					}
				
				}
				else{
					return  false;
					}
					
			}
			
			public function token_genrate($id){
				if(isset($id)){
					$_SESSION["id"]=$id;
					$_SESSION["token"]=md5($_SERVER['HTTP_USER_AGENT']);
					header("Location:dashboard.php");
					}
				}
			
		public function login_check(){
				if(empty($_SESSION["id"]) || $_SESSION["token"]!=md5($_SERVER['HTTP_USER_AGENT'])){
						header("Location:index.php");
					}
			}
			
		/*------------ logout coading -----------------*/		
			
		public function logout(){
			session_destroy();
			header("Location:../users/index.php");
			}
			
		
		public function stop_access_login(){
			
			if(!empty($_SESSION["token"])){
						header("Location:dashboard.php");
					}
			
			}	
			
		
		/*genrate runQuery*/
		private function runQuery($query){
			$stmt=$this->ncon->prepare($query);
			$stmt->execute();
			return $stmt;
			}
		//user exist or not	
		public function user_existance($tab_name,$email){
			$stmt=$this->runQuery("select id from $tab_name where email='".$email."'");
			if($stmt->rowCount()>0){
				return false;
				}
				else{
					return true;
					}
			}
			
		public function disease_existance($tab_name,$dis){
			$stmt=$this->runQuery("select sym_id from $tab_name where disease='".$dis."'");
			if($stmt->rowCount()>0){
				return false;
				}
				else{
					return true;
					}
			}
			
		public function admin_row_count(){
			$query=$this->runQuery("select id from admin");
			return $query->rowCount();
			}
		
		/*Set User Name for Admin*/	
		
		public function get_username($table_name,$id){
				$res=$this->runQuery("select name,email from ".$table_name." where id='".$id."'");
				while($row=$res->fetch(PDO::FETCH_OBJ)){
						$name=$row->name;
						$email=$row->email;
					}
					if(empty($name)){
						return $email;
						}
						else{
							return $name;
							}
			}
			
		public function type($table_name,$id){
				$res=$this->runQuery("select type from ".$table_name." where id='".$id."'");
				while($row=$res->fetch(PDO::FETCH_OBJ)){
						$type=$row->type;
					}
					if(!empty($type)){
						return $type;
						}
						else{
							return false;
							}
			}
			
		//bind insert function
		
		//insert data	
	public function bind_insert($tab_name,array $val){
		$data_count=count($val);
		for($i=0;$i<$data_count;$i++){
			$symbol[]="?";
			}
		$data=implode($symbol,",");
		$stmt=$this->ncon->prepare("insert into ".$tab_name." values(".$data.")");
		$stmt->execute($val);
		return $stmt;
		}	
			
		
		
	//update into table
	
	public function update($tab,array $col,$base_col){
			foreach($col as $k=>$v){
					$data[]=$k."='".$v."'";
					
					//update table_name set name='$value'
				}
				$col=implode($data,",");
				
				//for base_col
				
				foreach($base_col as $k=>$v){
					$data1[]=$k."='".$v."'";
					
					//update table_name set name='$value'
				}
				$base_col=implode($data1,",");
				
				$res=$this->runQuery("update ".$tab." set ".$col." where ".$base_col);
				if($res){
					return true;
					}
				
		}
		
		public function fetch($tabname,array $col,$id){
			foreach($col as $row){
				$col[]=$row;
				}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tabname." where id='".$id."'");
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}
			
			
		//reset password
		
		public function reset_pwd($tab_name,$old_pwd,$pwd,$npwd){
			$old_pwd=sha1(Controller::SALT.$old_pwd);
			$msg="";
			if($this->old_pwd_match($tab_name,$old_pwd)===true){
				if($pwd==$npwd){
					$npwd=sha1(Controller::SALT.$npwd);
					$this->runQuery("update ".$tab_name." set pwd='".$npwd."' where pwd='".$old_pwd."'");
					echo "Password update successfully done";
					}else{
						$msg="New password not match";
						}
				}
				else{
					$msg="Old password not match";
					}
				return $msg;	
			}
			
		private function old_pwd_match($tab_name,$old_pwd){
				$stmt=$this->runQuery("select id from ".$tab_name." where pwd='".$old_pwd."'");
				if($stmt->rowCount()==1){
					return true;
					}
					else{
						return false;
						}
			}
			
		
		//----------Global Code--------------//
		
		public function fetch_data($tab_name,array $col){
			foreach($col as $row){
			$col[]=$row;
			}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tab_name);
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}			
			
		public function fetch_data_treat($tab_name,array $col){
			foreach($col as $row){
			$col[]=$row;
			}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tab_name);
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}
			
		public function fetch_data_doctor($tab_name,array $col){
			foreach($col as $row){
			$col[]=$row;
			}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tab_name);
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}
			
		public function fetch_data_user($tab_name,array $col,$ty){
			foreach($col as $row){
			$col[]=$row;
			}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tab_name." where id='".$ty." ");
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}
			
		public function fetch_data_medicine($tab_name,array $col,$id){
			foreach($col as $row){
			$col[]=$row;
			}
			$cols=implode($col,",");	
			$result=$this->runQuery("select ".$cols." from ".$tab_name." where sym_id='".$id);
			if($result->rowCount()>0){
					while($row=$result->fetch(PDO::FETCH_OBJ)){
						$data[]=$row;
						}
					return $data;	
				}
			}
			
		//get symptom name base id
		
		public function getCategoryName($id){
			$stmt=$this->runQuery("select sym_name from disease where sym_id='".$id."'");
			if($stmt->rowCount()>0){
				while($row=$stmt->fetch(PDO::FETCH_OBJ)){
					return $row->sym_name;
					}

				}
			}
			
		public function getDiseaseName($id){
			$stmt=$this->runQuery("select disease from disease where sym_id='".$id."'");
			if($stmt->rowCount()>0){
				while($row=$stmt->fetch(PDO::FETCH_OBJ)){
					return $row->disease;
					}

				}
			}
			
		public function get_type($id){
			$stmt=$this->runQuery("select type from disease where sym_id='".$id."'");
			if($stmt->rowCount()>0){
				while($row=$stmt->fetch(PDO::FETCH_OBJ)){
					return $row->type;
					}

				}
			}
			
			public function get_doc_type($id){
			$stmt=$this->runQuery("select type from doctor where doc_id='".$id."'");
			if($stmt->rowCount()>0){
				while($row=$stmt->fetch(PDO::FETCH_OBJ)){
					return $row->type;
					}

				}
			}

		public function link_genrate($title){
			$title=preg_replace("/\s/","-",$title);
			return $title.".html";
			}	
			
	}
?>