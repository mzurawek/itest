<?
$html->SetTitle('Zarz±dzanie testami');


$test_id = $vars->Get('test_id');
$active = $vars->Get('active');

	if($active)
	{
		$query = new txtdb_UpdateQuery('options',array('value' => $test_id),"\$name == 'active_test'");
		$html->SetTitle('Aktywacja testu');
	}
	else
	{
		$query = new txtdb_UpdateQuery('options',array('value' => 0),"\$name == 'active_test'");
		$html->SetTitle('Dezaktywacja testu');
	}

	$dbi->query($query);

	$html->Redirect('admin.php?action=tests&subaction=menage',0);
	$html->Message('Status testu zmieniony',$lang['redirect'],$lang['go_now'],'admin.php?action=tests&subaction=menage',true);
?>
