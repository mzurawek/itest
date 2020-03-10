<?
		$html->SetTitle('Usuwanie');

		$confirmed = $vars->Get('confirmed');
		$id = $vars->Get('id');


if(!$confirmed) $html->Confirm('Czy jeste¶ pewien?', 'Czy na pewno chcesz usun±æ wybranego u¿ytkownika?',"admin.php?action=users&subaction=delete&id=$id&confirmed=1","admin.php?action=users&subaction=menage");
else{

		$query = new txtdb_DeleteQuery('users',"\$id == '$id'");
		$dbi->query($query);

		$query = new txtdb_DeleteQuery('answers',"\$user_id == '$id'");
		$dbi->query($query);

		$html->Redirect("admin.php?action=users&subaction=menage",0);
		$html->Message('U¿ytkownika usuniêto',$lang['redirect'],$lang['go_now'],"admin.php?action=users&subaction=menage",true);
}

?>
