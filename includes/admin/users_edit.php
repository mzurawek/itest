<?
$html->SetTitle('Edytuj u¿ytkownika');
$id = $vars->Get('id');

		$query = new txtdb_SelectQuery(array('id','login','password','name','class','access'),'users',"\$id == '$id'");
		$result = $dbi->query($query);

		$user_obj = new Iuser($dbi);
		$user_obj->FromArray($result->fetch());

		$array_user = $user_obj->ToArray();

		$query = new txtdb_SelectQuery(array('id','name'),'classes');
		$result = $dbi->query($query);
		$classes = array();
		while($record = $result->fetch())
		{
			if($user_obj->class == $record['id']) $record['selected'] = 'selected';
			else $record['selected'] = '';
			$classes[] = $record;
		}



$tpl_ads = new bTemplate();
$tpl_ads->set('user',$array_user,true);
$tpl_ads->set('is_admin',($user_obj->access == 'admin'),true);
$tpl_ads->set('classes',$classes,true);
echo $tpl_ads->fetch('template/admin/users_edit.tpl');

?>
