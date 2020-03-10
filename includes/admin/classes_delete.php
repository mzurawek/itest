<?

$confirmed = $vars->Get('confirmed');
$html->SetTitle('Usuwam test');
$id = $vars->Get('id');

if(!$confirmed) $html->Confirm('Czy jeste¶ pewien?', 'Czy na pewno chcesz usun±æ wybran± klasê?',"admin.php?action=classes&subaction=delete&id=$id&confirmed=1","admin.php?action=classes&subaction=menage");
else{
	$query = new txtdb_DeleteQuery('classes',"\$id == '$id'");
	$dbi->query($query);

	$query = new txtdb_UpdateQuery('users',array('class' => ''),"\$class == '$id'");
	$dbi->query($query);

	$html->Redirect("admin.php?action=classes&subaction=menage",0);
	$html->Message('Klasê usuniêto',$lang['redirect'],$lang['go_now'],"admin.php?action=classes&subaction=menage",true);
}


?>
