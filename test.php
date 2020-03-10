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

        $mode = $vars->Get('mode');

	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'active_test'");
	$result = $dbi->query($query);
	$record = $result->fetch();
	$active_test_id = $record['value'];

        if($mode != 2)
        {
          $html->menu->CreateSubmenu("main",2,"","Menu g³ówne");
 	  $html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');
	}

		if(!$user->logedin AND strlen($_COOKIE['itest'])>0)
		{
			$html->Error(true,'Test zablokowany','Mo¿liwo¶æ wype³niania tego testu z konta go¶cia zosta³a zablokowana na tym komputerze na okres 5 minut.',false);
		}
		else if($active_test_id == 0)
			$html->Error(true,'Brak aktywnego testu','Obecnie ¿aden test nie jest aktywny',false);
		else
		{
			//sprawdzamy czy test nie by³ ju¿ wype³niany
			$display_test = true;
			if($user->access != 'guest')
			{
					$query = new txtdb_SelectQuery(array('id'),'answers',"\$test_id == '$active_test_id' AND \$user_id == '$user->id'");
					$result = $dbi->query($query);
					if($result->count() > 0)
					{
                                                if($user->access != 'admin')
                                                {
                                                $record = $result->fetch();
						$html->Redirect('show_results.php?answer_id=' . $record['id'],5);
						$html->Message('Test by³ wype³niany','Ten test by³ ju¿ przez Ciebie wype³niany. Jeste¶ przenoszony do strony z wynikami.',$lang['go_now'],'show_results.php?answer_id=' . $record['id'],true);
						$display_test = false;
                                                }
                                                else
                                                {
                                                $query = new txtdb_DeleteQuery('answers',"\$test_id == '$active_test_id' AND \$user_id == '$user->id'");
					        $result = $dbi->query($query);
                                                }
					}
			}

			if($display_test)
			{


			$user_name = $vars->Get('guest_name');

			$test = new Itest($dbi);

			$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib','block_after'),'tests',"\$id == '$active_test_id'");
			$result = $dbi->query($query);
			$test->FromArray($result->fetch());

			if($test->access == 'admin' AND ($user->access == 'user' OR $user->access == 'guest')) $html->Error(true,'Brak dostêpu','Tylko administratorzy maj± dostêp do tego testu',false);
			if($test->access == 'user' AND $user->access == 'guest') $html->Error(true,'Brak dostêpu','Tylko zalogowani u¿ytkownicy maj± dostêp do tego testu.',false);

			$questions = array();
			$query = new txtdb_SelectQuery(array('id', 'test_id', 'question', 'correct_answer', 'high_level', 'answer1','answer2','answer3','answer4'),'questions',"\$test_id == '".$test->id."'");
			$result = $dbi->query($query);
				$question = new Iquestion($dbi);
				$nr = 1;
				while($record = $result->fetch())
				{
					$question->FromArray($record);
					$question_array = $question->ToArray();
					$question_array['nr'] = $nr;
					$nr++;
					$questions[] = $question_array;
				}
				if($test->random_questions)
				{
					srand ((float) microtime() * 10000000);
					$questions_rand_keys = array_rand($questions,count($questions));
						for($a=0;$a<count($questions);$a++)
						{
							$new_questions[$a] = $questions[$questions_rand_keys[$a]];
						}
					$questions = $new_questions;
				}

				$questions_with_randed_answers = array();
				foreach($questions as $nr => $question)
				{
					$randed_question = $question;
					$answers_array = array(1,2,3,4);
					$answers_array = array_rand($answers_array,4);
					$answers_array[0]++;$answers_array[1]++;$answers_array[2]++;$answers_array[3]++;

					$randed_question['randed_answer1'] = $randed_question['answer' . $answers_array[0]];
					$randed_question['randed_answer1_nr'] = $answers_array[0];
					$randed_question['randed_answer2'] = $randed_question['answer' . $answers_array[1]];
					$randed_question['randed_answer2_nr'] = $answers_array[1];
					$randed_question['randed_answer3'] = $randed_question['answer' . $answers_array[2]];
					$randed_question['randed_answer3_nr'] = $answers_array[2];
					$randed_question['randed_answer4'] = $randed_question['answer' . $answers_array[3]];
					$randed_question['randed_answer4_nr'] = $answers_array[3];
					#die(print_r($answers_array));
					$questions_with_randed_answers[] = $randed_question;
				}
				$questions = $questions_with_randed_answers;

			//zabawa z czasem
                        $start_time = time();
                        if($user->logedin)
                        {
                            if(strlen($_COOKIE['itest_start_time'])>0)
                            {
                                $start_time = $_COOKIE['itest_start_time'];
                                if((time() - $start_time) > ($test->fill_time * 60))
                                {
                                   $start_time = time() - (($test->fill_time * 60) - 5);
                                   setcookie('itest_start_time',$start_time);
                                }
                            }
                            else
                            {
                             setcookie('itest_start_time',time());
                             $start_time = time();
                            }
                        }

                        $questions_text = array();
                        foreach($questions as $question)
                        {
                           $question_tpl = new bTemplate();
                           $question_tpl->set('question',$question);
                           $question_tpl->set('no_crib',$test->no_crib,true);
                           //poprawic bo tu losowana kolejnosc
                           $question_tpl->set('show_answer1',($question['randed_answer1'] == '') ? (false) : (true),true);
                           $question_tpl->set('show_answer2',($question['randed_answer2'] == '') ? (false) : (true),true);
                           $question_tpl->set('show_answer3',($question['randed_answer3'] == '') ? (false) : (true),true);
                           $question_tpl->set('show_answer4',($question['randed_answer4'] == '') ? (false) : (true),true);
                           
                              $questions_text[] = $question_tpl->fetch('template/test_question.tpl');
                        }


                        $tpl->set('questions_text',$questions_text);
			$tpl->set('test',$test->ToArray());
			$tpl->set('guest_name',$guest_name);
			$tpl->set('mode',$mode);
			$tpl->set('start_time',$start_time);
			$tpl->set('script_start_time',$start_time * 1000);

			$tpl->set('start_time_text',date("H:i:s",$start_time));

			$tpl->set('is_fill_time',$test->fill_time,true);
			$tpl->set('fill_time_seconds',$test->fill_time*60,true);
			$tpl->set('fill_time_alert_seconds',($test->fill_time*60)-60,true);
			#if($test->fill_time) $html->


                        $questions_to_checkform = array();
                        $second = false;
                        foreach($questions as $nr => $key)
                        {
                          if($second) $key['or'] = '||';
                          else $key['or'] = '';
                          $second = true;
                          $questions_to_checkform[] = $key;
                        }

                        $tpl->set('questions_array',$questions_to_checkform);

                        if($user->access == 'guest')
	                {
			        $user_name = $guest_name;
                                if($mode != 2) $user_name .= " (go¶æ)";
	                }
	                else if($user->name != "") $user_name = $user->name . " (".$user->login.")";
	                else $user_name = $user->login;


                        $html->menu->CreateSubmenu("user",3,"","Twoje dane");
                        $html->menu->{'user'}->content = "<center>$user_name</center>";
                        if($user->logedin)
                        {
                                $html->menu->{'user'}->content .= "<br>";
                                $html->menu->{'user'}->linksbox->Add(1,'Wyloguj siê','login.php?action=logout');
                        }


			$html->SetContent($tpl->fetch('template/test.tpl'));
			}//if: je¿eli test nie by³ jeszcze wype³niany

		}


	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	$user->Save();

	# Wysy³anie kodu HTML do przegladarki
	$html->Output();

?>
