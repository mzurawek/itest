<?
	$id = $vars->Get('id');


	$query = new txtdb_DeleteQuery('answers',"\$id == '$id'");
	$dbi->query($query);

	$html->Redirect("admin.php?action=results&subaction=class",0);
	$html->Message('Wynik usunieto',$lang['redirect'],$lang['go_now'],"admin.php?action=results&subaction=class",true);

?>
