<?

	$query = new txtdb_SelectQuery(array('id','name'),'classes');
	$result = $dbi->query($query);
	while($record = $result->fetch())
	{
			$classes[$record['id']] = $record['name'];
	}
	$classes[''] = 'Bez klasy';
	$tree = array();


	foreach($classes as $class_id => $class_name)
	{
		$users = array();
		$query = new txtdb_SelectQuery(array('id','login','password','name','class','access'),'users',"\$class == '$class_id'");
		$result = $dbi->query($query);
		$user_obj = new Iuser($dbi);
		while($record = $result->fetch())
		{
			$user_obj->FromArray($record);
			$array_user = $user_obj->ToArray();

				$array_user['edit_link'] = "<a href=\"admin.php?action=users&subaction=edit&id=".$user_obj->id."\">Edytuj</a>";
				$array_user['delete_link'] = "<a href=\"admin.php?action=users&subaction=delete&id=".$user_obj->id."\">Usuñ</a>";
				$array_user['class_name'] = $classes[$array_user['class']];

				if($user->id == $array_user['id'])
				{
					$array_user['name'] = "<b>" . $array_user['name'] . "</b>";
					$array_user['login'] = "<b>" . $array_user['login'] . "</b>";
					$array_user['delete_link'] = '';
				}
				if($array_user['access'] == 'admin') $array_user['access_text'] = "administrator";
				else $array_user['access_text'] = "uzytkownik";
 			$users[] = $array_user;
		}
		$not_empty = !empty($users);

		$sub_tpl = new bTemplate();
		$sub_tpl->set('users',$users);
		$sub_tpl->set('not_empty',$not_empty,true);
		$tree[] = array('class_name' => $class_name, 'content' => $sub_tpl->fetch('template/admin/users_menage_class_list.tpl'));
	}



	/*$query = new txtdb_SelectQuery(array('id','login','password','name','class','access'),'users');
	$result = $dbi->query($query);
	$user_obj = new Iuser($dbi);
	while($record = $result->fetch())
	{
		$user_obj->FromArray($record);
		$array_user = $user_obj->ToArray();

			$array_user['edit_link'] = "<a href=\"admin.php?action=users&subaction=edit&id=".$user_obj->id."\">Edytuj</a>";
			$array_user['delete_link'] = "<a href=\"admin.php?action=users&subaction=delete&id=".$user_obj->id."\">Usuñ</a>";
			$array_user['class_name'] = $classes[$array_user['class']];

			if($user->id == $array_user['id'])
			{
				$array_user['name'] = "<b>" . $array_user['name'] . "</b>";
				$array_user['login'] = "<b>" . $array_user['login'] . "</b>";
				$array_user['delete_link'] = '';
			}
		$users[] = $array_user;
	}*/

$sub_tpl = new bTemplate();
$sub_tpl->set('tree',$tree);
echo $sub_tpl->fetch('template/admin/users_menage.tpl');

?>
