<?
/* 
Klasa Tuser
(C)Copyright 2004 by Mariusz ¯urawek
All rights reserved
*/


# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

class Iuser { 
 	var $id = 0;
 	var $login = '';
 	var $password = '';
 	
 	var $name = '';
 	
 	var $class = '';
 	var $access = 'guest';
 	/*
 	guest, user, admin
 	*/
 	
 	
 	var $logedin; # Nie zapisywane w bazie!
 	var $dbi; #Referencja do bazy danych # Nie zapisywane w bazie!

	//-----------------------------------------------------------------------------   	 	
  	function Iuser(&$dbi){
		$this->dbi = &$dbi;
		$this->logedin = false;
 	} 		 	
	//-----------------------------------------------------------------------------   	 	
  	function SetDBI(&$dbi){
		$this->dbi = &$dbi;
 	} 		
	//----------------------------------------------------------------------------- 	
 	function Set($id,$login,$password,$name,$class,$access,$logedin){
 		$this->id = $id;
 		$this->login = $login;
 		$this->password = $password;
 		$this->name = $name;
 		$this->class = $class;
 		$this->access = $access;
 		$this->logedin = $logedin;	
 	}	
	//----------------------------------------------------------------------------- 
 	 function SaveData(){
 	 	#$new_user_id = time() . rand(0,99);
 	 	#die($new_user_id);
 	 	$query = new txtdb_UpdateQuery("users",
 	 	array(
 	 	'login' => $this->login, 
 	 	'password' => $this->password,
 	 	'name' => $this->name, 
 	 	'class' => $this->class,
 	 	'access' => $this->access,
 	 	),"id == $this->id");
 	 	$this->dbi->query($query);
 	}	
	//----------------------------------------------------------------------------- 	
 	function LoadData($id = true){
 		
  		if($id) $where = "\$id == '" . $this->id . "'";
  		else $where = "\$login == '" . $this->login . "'";
  		
  		$query= new txtdb_SelectQuery(array('id','login','password','name','class','access'),'users',$where,'',1);
  		
		$result = $this->dbi->query($query);

		if( $result->count() == 0){
			$this->Clean();
		}
		else{
			$record = $result->fetch();
			$this->FromArray($record);
		}
	}
	//----------------------------------------------------------------------------- 	
 	function LogIn($login, $password){
 		
 		if(strlen($password)==0){ 
 			$this->logedin = false;
 			return;
 		}
 		$query = new txtdb_SelectQuery(array('login','password'),'users',"\$login == '$login'",'',1);
 		$result = $this->dbi->query($query);

		# Nie ma takiego u¿ytkownika
		if($result->count() == 0){
			$this->Clean();
			return;
		}
		
		$record = $result->fetch();
		
		if($record['password'] == $password) 
			$this->logedin = true;
		else 
		{
			$this->Clean();
			return;
		}
		
		
		
  		$this->login = $login;
  		$this->password = $password;
  		
  		$this->logedin = true;
		$this->LoadData(false);	
 	} 	
	//----------------------------------------------------------------------------- 	
 	function Get(){
 		# Sprawdzamy czy sesja zawiera jakie¶ dane
 		if(isset($_SESSION['id']) AND strlen($_SESSION['id'])>0){
 			$this->id = $_SESSION['id'];
 			$this->logedin = true;
 			$this->LoadData();
 		}
 		else{
 			$cookie = $_COOKIE["itest"];
			if(strlen($cookie)>0)
			{
				$cookie = explode("|-|",$cookie);
				$this->LogIn($cookie[0], base64_decode($cookie[1]));	
				$this->Save('none');
			}
			else $this->Clean();
 		}
 	} 
	//----------------------------------------------------------------------------- 	
 	function Save($cookie_action = 'none'){	
 		if(!$this->logedin) return;

 		$_SESSION['id'] = $this->id;
 		
 		if($cookie_action != 'none'){	
 			if($cookie_action == 'save'){
 				$tmp = $this->login . "|-|" . base64_encode($this->password);
 				setcookie('itest',$tmp,time() + 2592000);
 			}
 			elseif($cookie_action == 'delete'){
 				setcookie('itest','', time() - 100); 
 			}
 		}
 	} 	
	//-----------------------------------------------------------------------------
 	 function Clean(){
 		$this->Set(0,'','','','','guest',false);
 	}
	//----------------------------------------------------------------------------- 	
 	 function LogOut(){
 	 	$this->Save('delete');
 	 	$_SESSION['id'] = '';
 		$this->Clean();
 	}
	//----------------------------------------------------------------------------- 
 	 function ToArray(){
 	 	$result = array(
 	 	'id' => $this->id,
 	 	'login' => $this->login, 
 	 	'password' => $this->password,
 	 	'name' => $this->name, 
 	 	'class' => $this->class,
 	 	'access' => $this->access
 	 	);
 	 	return $result;
 	}
	//----------------------------------------------------------------------------- 
 	 function FromArray($result){ 	 
 	 	$this->Set($result['id'],$result['login'],$result['password'],$result['name'],$result['class'],$result['access'],$this->logedin);
 	}
	//-----------------------------------------------------------------------------	
	
} #class Iuser
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


?>
