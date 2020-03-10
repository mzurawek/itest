<?
$html->SetTitle('Zarz±dzanie testami');

	$tests = array();

	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'active_test'");
	$result = $dbi->query($query);
	$record = $result->fetch();
	$active_test_id = $record['value'];

	$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests');
	$result = $dbi->query($query);
	while($record = $result->fetch())
	{
		$is_active = ($active_test_id == $record['id']) ? (true) : (false);
		$tmp_test = $record;
		$tmp_test['time_create_text'] = date("H:i, d-m-Y",$tmp_test['create_time']);
		if($is_active) $tmp_test['title'] = "<b>" . $tmp_test['title'] . "</b>";

		$tmp_test['activate_link'] =
			($is_active) ? ("<a href=\"admin.php?action=tests&subaction=activate&active=0&test_id=".$tmp_test['id']."\">Dezaktywuj</a>")
			: ("<a href=\"admin.php?action=tests&subaction=activate&active=1&test_id=".$tmp_test['id']."\">Aktywuj</a>");
		$tests[] = $tmp_test;
	}
	$not_empty = !empty($tests);

$sub_tpl = new bTemplate();
$sub_tpl->set('tests',$tests);
$sub_tpl->set('not_empty',$not_empty,true);
echo $sub_tpl->fetch('template/admin/tests_menage.tpl');

?>
