<?
$html->SetTitle('Zarz±dzanie testami');
$html->SetTitle('Usuwanie testu');

$confirmed = $vars->Get('confirmed');
$test_id = $vars->Get('test_id');

if(!$confirmed) $html->Confirm('Czy jeste¶ pewien?', 'Czy na pewno chcesz usun±æ wybrany test?',"admin.php?action=tests&subaction=menage_delete&test_id=$test_id&confirmed=1","admin.php?action=tests&subaction=menage");
else{
	$query = new txtdb_DeleteQuery('tests',"\$id == '$test_id'");
	$dbi->query($query);

	$query = new txtdb_DeleteQuery('answers',"\$test_id == '$test_id'");
	$dbi->query($query);

	$query = new txtdb_DeleteQuery('questions',"\$test_id == '$test_id'");
	$dbi->query($query);

	$html->Redirect('admin.php?action=tests&subaction=menage',0);
	$html->Message('Test usuniêto',$lang['redirect'],$lang['go_now'],'admin.php?action=tests&subaction=menage',true);
}

?>
