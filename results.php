<?

	include("includes/global.php");
	include("includes/lang.php");

	include("txtdb.class.php");
	include("classes/var.php");
	
	include("classes/obj.php");
	include("classes/img.php");
	include("classes/user.php");
	include("classes/html.php");
	include("classes/btemplate.php");
	include("classes/test.php");
	include("classes/question.php");	

	#include("includes/functions_options.php");
	include("functions/main.php");
	
	$dbi = new txtDB;
	$dbi->connect('itest','');
	$GLOBALS['dbi'] = $dbi;
	

	$vars = new Ivar;

	session_start();
	
	$user = new Iuser($dbi);
	$user->Get();
	

	$html = new Ihtml($dbi);
	$action = $vars->Get('action');

	include("includes/template_start.php");

	ob_start();
	
	
	# G³owny szablon contentu
	$tpl = new bTemplate();
	##Content strony
	## End: content strony...
	$test_id = $vars->Get('test_id');
	$start_time = $vars->Get('start_time');
        if($user->logedin)
        {
         if(strlen($_COOKIE['itest_start_time']) > 0)
         {
            $start_time = $_COOKIE['itest_start_time'];
         }
        }

        $mode = $vars->Get('mode');
	
	$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests',"\$id == '$test_id'");
	$result = $dbi->query($query);
	$test = new Itest($dbi);
	$test->FromArray($result->fetch());
	
	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'grades'");
	$result = $dbi->query($query);
	$record = $result->fetch();
	$grades = unserialize($record['value']);
	
	$query = new txtdb_SelectQuery(array('id','correct_answer'),'questions',"\$test_id == '$test_id'");
	$result = $dbi->query($query);
	
	unset($correct_test_answers);
		while($record = $result->fetch())
		{
			$correct_test_answers[$record['id']] = $record['correct_answer'];
		}
	unset($test_answers);
	$correct_count = 0;
	foreach($correct_test_answers as $question_id => $correct_answer)
	{
		$user_test_answer = $vars->Get('question_' . $question_id);
		$test_answers[$question_id] = $user_test_answer;
		if($correct_test_answers[$question_id] == $user_test_answer) $correct_count++;
	}
	
	$result = $correct_count;
	$result_max = count($test_answers);
	$percent = round(($result * 100)/$result_max);
	if($percent < $grades['grade_2']) $grade = 1;
	else if($percent < $grades['grade_3']) $grade = 2;
	else if($percent < $grades['grade_4']) $grade = 3;
	else if($percent < $grades['grade_5']) $grade = 4;
	else if($percent < $grades['grade_6']) $grade = 5;
	else $grade = 6;
	
	$tmp_user_id = 0;
	if($user->logedin)
	{ 
		$tmp_user_id = $user->id;
		$guest_name = '';
	}
	else 
	{
		$guest_name = $vars->Get('guest_name');
		if($test->block_after) setcookie('itest','block',time()+300);
	}
	setcookie('itest_start_time','',time()-100);
	
	
	$uq_answer_id = (time() . rand(0,99));
	
	$query = new txtdb_InsertQuery('answers',array('id' => $uq_answer_id, 'test_id' => $test_id,
		'user_id' => $tmp_user_id,'guest_name' => $guest_name,'answers' => serialize($test_answers),'time_start' => $start_time,'time_end' => time(),'result' => $result,
		'result_max' => $result_max,'percent' => $percent,'grade' => $grade));
	$dbi->query($query);
	
	
	$html->Redirect("show_results.php?answer_id=$uq_answer_id",0);
	$html->Message('Czekaj',$lang['redirect'],$lang['go_now'],"show_results.php?answer_id=$uq_answer_id",true);
 
		
	//jezeli uzytkownik to gosc, blokada wypelniania na 5 minut!!!
	
	
	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	$user->Save();

	# Wysy³anie kodu HTML do przegladarki
	$html->Output();

?>

