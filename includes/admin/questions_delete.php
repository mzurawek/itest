<?
$html->SetTitle('Usuwam test');

$id = $vars->Get('id');

$query = new txtdb_DeleteQuery('questions',"\$test_id == '$test_id' AND \$id == '$id'");
$dbi->query($query);

$html->Redirect("admin.php?action=questions&subaction=menage&test_id=$test_id",0);
$html->Message('Pytanie usuniêto',$lang['redirect'],$lang['go_now'],"admin.php?action=questions&subaction=menage&test_id=$test_id",true);



?>
