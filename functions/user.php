<?

/* 
Modu³ user
(C)Copyright 2004 by Mariusz ¯urawek
All rights reserved
*/

function user_Add($login,$password,$name,$class,$access)
{
	global $dbi;
	$new_user_id = time() . rand(0,99);
	$query = new txtdb_InsertQuery('users',array(
		'id' => $new_user_id,
		'login' => $login,
		'password' => $password,
		'name' => $name,
		'class' => $class,
		'access' => $access
	));
	$result = $dbi->query($query);
	return $result;
}

function user_Delete($id)
{
	global $dbi;
	$query = new txtdb_DeleteQuery('users',"id == '$id'");
	$result = $dbi->query($query);
	return $result;
}

function user_IsLoginTaked($login)
{
	global $dbi;
	$query = new txtdb_SelectQuery(array('login'),'users',"login == '$login'",'',1);
	$result = $dbi->query($query);
	
	if($result->count() == 1) return true;
	else return false;
}


?>