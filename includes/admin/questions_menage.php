<?
$html->SetTitle('Zarz±dzanie');
#$test_id

	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'active_test'");
	$result = $dbi->query($query);
	$record = $result->fetch();
	$active_test_id = $record['value'];


	$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests',"\$id == '$test_id'");
	$result = $dbi->query($query);
	$test = $result->fetch();
	$is_active = ($active_test_id == $test['id']) ? (true) : (false);

	$test['time_create_text'] = date("H:i, d-m-Y",$test['create_time']);
	$test['activate_link'] =
			($is_active) ? ("<a href=\"admin.php?action=tests&subaction=activate&active=0&test_id=".$test['id']."\">Dezaktywuj</a>")
			: ("<a href=\"admin.php?action=tests&subaction=activate&active=1&test_id=".$test['id']."\">Aktywuj</a>");

	$not_empty = true;
	$questions = array();

	$query = new txtdb_SelectQuery(array('id', 'test_id', 'question', 'correct_answer', 'high_level', 'answer1','answer2','answer3','answer4'),'questions',"\$test_id == '".$test_id."'");
	$result = $dbi->query($query);
	$nr=1;
	while($record = $result->fetch())
	{
		$question_obj = new Iquestion($dbi);
		$question_obj->FromArray($record);
		$tmp_question = $question_obj->ToArray();
		$tmp_question['edit_link'] = "<a href=\"admin.php?action=questions&subaction=edit&id=".$question_obj->id."&test_id=".$test_id."\">Edytuj</a>";
		$tmp_question['delete_link'] = "<a href=\"admin.php?action=questions&subaction=delete&id=".$question_obj->id."&test_id=".$test_id."\">Usuñ</a>";
		$tmp_question['answer' . $tmp_question['correct_answer']] = "<u>" . $tmp_question['answer' . $tmp_question['correct_answer']] . "</u>";
		$tmp_question['nr'] = $nr;
		$nr++;
		$questions[] = $tmp_question;
	}
	$not_empty = !empty($questions);

$sub_tpl = new bTemplate();
$sub_tpl->set('test',$test);
$sub_tpl->set('questions',$questions);
$sub_tpl->set('not_empty',$not_empty,true);
echo $sub_tpl->fetch('template/admin/questions_menage.tpl');

?>
