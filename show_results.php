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

        $mode = $vars->Get('mode');

        if($mode != 2)
        {
          $html->menu->CreateSubmenu("main",1,"","Menu g³ówne");
	  $html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');
	}

        if($user->access == 'admin')
        {
	   $html->menu->{'main'}->linksbox->Add(1,'Administracja','admin.php');
	}
	
	ob_start();


	# G³owny szablon contentu
	$tpl = new bTemplate();
	##Content strony
	## End: content strony...
	$answer_id = $vars->Get('answer_id');
	$show_answers = $vars->Get('show_answers');

	$query = new txtdb_SelectQuery(array('id','test_id','user_id','guest_name','answers','time_start','time_end','result','result_max','percent','grade'),'answers',"\$id == '$answer_id'");
	$result = $dbi->query($query);
	$answer = $result->fetch();

	$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests',"\$id == '".$answer['test_id']."'");
	$result = $dbi->query($query);
	$test = new Itest($dbi);
	$test->FromArray($result->fetch());

	if($answer['user_id'] != 0)
	{
		$query = new txtdb_SelectQuery(array('id','login','password','name','class','access'),'users',"\$id == '".$answer['user_id']."'");
		$result = $dbi->query($query);
		$answer_user = new Iuser($dbi);
		$answer_user->FromArray($result->fetch());
	}
	else
	{
		$answer_user = new Iuser($dbi);
		$answer_user->access = 'guest';
		$answer_user->id = 0;
	}

	//wy¶wietlanie pytañ i odpowiedzi
	$questions_and_answers = array();
	if($show_answers)
	{
	$u_answers = unserialize($answer['answers']);
		foreach($u_answers as $question_id => $user_answer)
		{
			$query = new txtdb_SelectQuery(array('id','test_id','question','answer1','answer2','answer3','answer4','high_level', 'correct_answer'),'questions',"\$id == '$question_id'");
			$result = $dbi->query($query);
			$tmp_question = $result->fetch();

			$tmp_answer = $tmp_question['answer'.$user_answer];
			if($user_answer==0) $tmp_answer = 'Brak odpowiedzi';

			if($user_answer != $tmp_question['correct_answer'])
			{
				$correct_answer_should_be = $tmp_question['answer'.$tmp_question['correct_answer']];
				$tmp_answer = '<font color=red>' . $tmp_answer . '</font> (prawid³owa odpowied¼: ' . $correct_answer_should_be . ') ';
			}
			$questions_and_answers[] = array('question' => $tmp_question['question'], 'answer' => $tmp_answer);
		}
	}

	//wyswietlamy wyniki
	if($answer_user->access == 'guest')
	{
		if($answer['guest_name'] == '')
			$user_name = " brak nazwy (go¶æ)";
		else
		{

			$user_name = $answer['guest_name'];
                        if($mode != 2) $user_name .= " (go¶æ)";
                }
	}
	else if($answer_user->name != "") $user_name = $user->name;
	else $user_name = $answer_user->login;

        if($user->access != 'admin' AND $show_answers) $show_answers=false;

	$tpl->set('show_answers',$show_answers,true);
	$tpl->set('questions_and_answers',$questions_and_answers,true);

	$tpl->set('test',$test->ToArray());
	$tpl->set('result',$answer['result']);
	$tpl->set('result_max',$answer['result_max']);
	$tpl->set('percent',$answer['percent']);
	$tpl->set('grade',$answer['grade']);
	$tpl->set('start_time_text',date("H:i:s",$answer['time_start']));
	$tpl->set('end_time_text',date("H:i:s",$answer['time_end']));
	$tpl->set('day',date("Y-m-d"),$answer['time_end']);
	$tpl->set('user_name',$user_name);

	$html->SetContent($tpl->fetch('template/test_results.tpl'));



	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	$user->Save();

	# Wysy³anie kodu HTML do przegladarki
	$html->Output();

?>

