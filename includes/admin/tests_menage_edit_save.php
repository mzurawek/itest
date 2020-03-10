<?
$html->SetTitle('Zarz±dzanie testami');
$html->SetTitle('Edycja testu');
$html->SetTitle('Zapisywanie');

$test_id = $vars->Get('test_id');
$title = $vars->Get('title');
$desc = $vars->Get('desc',3);
$access = $vars->Get('access');

$fill_time = $vars->Get('fill_time');
if($fill_time != '' AND !ereg ('[0-9]', $fill_time)) $html->Error(true,'Podany przez ciebie czas nie ejst liczb±','nie liczba',true);


$random_questions = $vars->Get('random_questions');
$no_crib = $vars->Get('no_crib');
$block_after = $vars->Get('block_after');

$test = new Itest($dbi);

$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib','block_after'),'tests',"\$id == '$test_id'",'',1);
$result = $dbi->query($query);
$test->FromArray($result->fetch());

$test->title = $title;
$test->desc = $desc;
$test->access = $access;
$test->fill_time = $fill_time;
$test->random_questions = ($random_questions) ? true : false;
$test->no_crib = ($no_crib) ? true : false;
$test->block_after = ($block_after) ? true : false;

$query = new txtdb_UpdateQuery('tests',$test->ToArray(),"\$id == '$test_id'");
$dbi->query($query);

$html->Redirect('admin.php?action=tests&subaction=menage',0);
$html->Message('Test zmieniono',$lang['redirect'],$lang['go_now'],'admin.php?action=tests&subaction=menage',true);



?>
