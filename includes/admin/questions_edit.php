<?
$html->SetTitle('Zarz±dzanie pytaniami');
$html->SetTitle('Edycja');

$id = $vars->Get('id');

$question_obj = new Iquestion($dbi);

$query = new txtdb_SelectQuery(array('id', 'test_id', 'question', 'correct_answer', 'high_level', 'answer1','answer2','answer3','answer4'),'questions',"\$test_id == '".$test_id."' AND \$id == '$id'");
$result = $dbi->query($query);
$question_obj->FromArray($result->fetch());

$tmp_question  = $question_obj->ToArray();
$tmp_question['answer_1_checked'] = ($question_obj->correct_answer == 1) ? ('checked') : ('');
$tmp_question['answer_2_checked'] = ($question_obj->correct_answer == 2) ? ('checked') : ('');
$tmp_question['answer_3_checked'] = ($question_obj->correct_answer == 3) ? ('checked') : ('');
$tmp_question['answer_4_checked'] = ($question_obj->correct_answer == 4) ? ('checked') : ('');

$sub_tpl = new bTemplate();
$sub_tpl->set('test_id',$test_id);
$sub_tpl->set('question',$tmp_question);
echo $sub_tpl->fetch('template/admin/questions_edit.tpl');

?>
