<?
$html->SetTitle('Dodaj reklamê');

$question = $vars->Get('question',3);

$correct_answer = $vars->Get('correct_answer');
$answer1 = $vars->Get('answer1');
$answer2 = $vars->Get('answer2');
$answer3 = $vars->Get('answer3');
$answer4 = $vars->Get('answer4');

$question_obj = new Iquestion($dbi);
$question_obj->id = time() . rand(0,99);
$question_obj->test_id = $test_id;
$question_obj->question = $question;
$question_obj->correct_answer = $correct_answer;
$question_obj->answer1 = $answer1;
$question_obj->answer2 = $answer2;
$question_obj->answer3 = $answer3;
$question_obj->answer4 = $answer4;

$query = new txtdb_InsertQuery('questions',$question_obj->ToArray());
$dbi->query($query);

$html->Redirect("admin.php?action=questions&subaction=menage&test_id=$test_id",0);
$html->Message('Pytanie dodano',$lang['redirect'],$lang['go_now'],"admin.php?action=questions&subaction=menage&test_id=$test_id",true);



?>
