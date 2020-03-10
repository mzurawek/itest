<?
	$class_id = $vars->Get('class_id');
	$test_id = $vars->Get('test_id');
		if($class_id == '' OR $test_id == '')
		{
			$html->SetTitle('Wyb�r klasy');

			$classes = array();
			$query = new txtdb_SelectQuery(array('id','name'),'classes');
			$result = $dbi->query($query);
			while($record = $result->fetch())
			{
				$class = $record;
				$classes[] = $class;
			}

			$tests = array();
			$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests');
			$result = $dbi->query($query);
			while($record = $result->fetch())
			{
				$tests[] = $record;
			}

			if(count($tests) == 0)
			{
				$html->Error(true,'Brak test�w','W systemie nie ma test�w, dla kt�rych mo�na by wy�wietli� wyniki.',false);
			}

			$sub_tpl = new bTemplate();
			$sub_tpl->set('tests',$tests);
			$sub_tpl->set('classes',$classes);
			echo $sub_tpl->fetch('template/admin/results_class_select.tpl');
		}
		else
		{
                        if($class_id != 'all' AND $class_id == 0) $class_id = '';

                        $class_query = "\$class == '$class_id'";

                        if($class_id == 'all') $class_query = '';

			$query = new txtdb_SelectQuery(array('id','login','name'),'users',$class_query);
			$result = $dbi->query($query);
			$user_id_query = '';

			if($result->count() == 0 AND $class_id != '' AND $class_id != 'all')
			{
				$html->Error(true,'B��d','Do podanej klasy nie zosta� przypisany �aden u�ytkownik.',true);
			}

			($result->count() > 1) ? ($add_or = true) : ($add_or = false);
			unset($users_names);
                        $second = false;
                        while($record = $result->fetch())
			{
				($record['name'] == '') ? ($user_name = $record['login']) : ($user_name = $record['name']);
				$users_names[$record['id']] = $user_name;
                                if($add_or AND $second) $user_id_query .= "OR ";
                                $second = true;
                                $user_id_query .= "\$user_id == '".$record['id']."' ";

			}
if($class_id == '' OR $class_id == 'all')
{
    if(strlen($user_id_query) > 0) $user_id_query .= "OR ";
    $user_id_query .= "\$user_id == '0' ";
}

			$query = new txtdb_SelectQuery(array('id','test_id','user_id','guest_name','answers','time_start','time_end','result','result_max','percent','grade'),'answers',"\$test_id == '$test_id' AND (" .$user_id_query. ")");

			$answers = array();
			$result = $dbi->query($query);
			if($result->count() == 0) $html->Error(true,'Brak danych','�aden z u�ytkownik�w nale�acych do wybranej klasy, nie wype�nia� wybranego testu.',true);

			while($record = $result->fetch())
			{
				$tmp_record = $record;

				if($tmp_record['user_id'] == 0) $user_name = $tmp_record['guest_name'] ." (go��)";
				else $user_name = $users_names[$tmp_record['user_id']];

				$tmp_record['user_name'] = $user_name;
				$tmp_record['delete_link'] = "<a href='admin.php?action=results&subaction=delete&id=" . $tmp_record['id'] . "'>Usu�</a>";
				$tmp_record['show_answers_link'] = "<a href='show_results.php?show_answers=wxp&answer_id=" . $tmp_record['id'] . "'>Pe�ny podgl�d</a>";
				$answers[] = $tmp_record;
			}

			$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),'tests',"\$id == '".$test_id."'");
			$result = $dbi->query($query);
			$test = new Itest($dbi);
			$test->FromArray($result->fetch());

			$sub_tpl = new bTemplate();
			$sub_tpl->set('answers',$answers);
			$sub_tpl->set('test',$test->ToArray());
			echo $sub_tpl->fetch('template/admin/results_class_show.tpl');
		}

?>
