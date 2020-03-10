<?
$html->SetTitle('Zarz±dzanie klasami');
$html->SetTitle('Edycja');
$html->SetTitle('Zapisywanie');

$id = $vars->Get('id');
$name = $vars->Get('name');

$query = new txtdb_UpdateQuery('classes',array('id' => $id, 'name' => $name),"\$id == '$id'");
$dbi->query($query);

$html->Redirect("admin.php?action=classes&subaction=menage",0);
$html->Message('Pytania zmieniono',$lang['redirect'],$lang['go_now'],"admin.php?action=classes&subaction=menage",true);



?>
