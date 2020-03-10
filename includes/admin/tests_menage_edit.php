<?
$html->SetTitle('Zarz±dzanie testami');
$html->SetTitle('Edycja testu');

$test_id = $vars->Get('test_id');

$test = new Itest($dbi);

$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib', 'block_after'),'tests',"\$id == '$test_id'",'',1);
$result = $dbi->query($query);
$test->FromArray($result->fetch());

$tmp_test  = $test->ToArray();
$tmp_test['access_1_checked'] = ($test->access == 1) ? ('selected') : ('');
$tmp_test['access_2_checked'] = ($test->access == 2) ? ('selected') : ('');
$tmp_test['access_3_checked'] = ($test->access == 3) ? ('selected') : ('');

$tmp_test['random_questions_checked'] = ($test->random_questions) ? ('checked') : ('');
$tmp_test['no_crib_checked'] = ($test->no_crib) ? ('checked') : ('');
$tmp_test['block_after_checked'] = ($test->block_after) ? ('checked') : ('');

$sub_tpl = new bTemplate();
$sub_tpl->set('test',$tmp_test);
echo $sub_tpl->fetch('template/admin/tests_menage_edit.tpl');

?>
