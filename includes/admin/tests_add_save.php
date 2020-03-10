<?
$html->SetTitle('Dodawanie nowego testu');
$html->SetTitle('Zapisywanie');

$title = $vars->Get('title');
$desc = $vars->Get('desc',3);
$access = $vars->Get('access');

$fill_time = $vars->Get('fill_time');
if($fill_time != '' AND !ereg ('[0-9]', $fill_time)) $html->Error(true,'Podany przez ciebie czas nie ejst liczb±','nie liczba',true);


$random_questions = $vars->Get('random_questions');
$no_crib = $vars->Get('no_crib');
$block_after = $vars->Get('block_after');


$new_test = new Itest($dbi);
$new_test->id = time() . rand(0,99);
$new_test->title = $title;
$new_test->desc = $desc;
$new_test->access = $access;
$new_test->fill_time = $fill_time;
$new_test->random_questions = ($random_questions) ? true : false;
$new_test->no_crib = ($no_crib) ? true : false;
$new_test->block_after = ($block_after) ? true : false;
$new_test->create_time = time();
$new_test->creator_id = $user->id;

$query = new txtdb_InsertQuery('tests',$new_test->ToArray());
$dbi->query($query);

$html->Redirect('admin.php?action=tests&subaction=menage',0);
$html->Message('Test dodano',$lang['redirect'],$lang['go_now'],'admin.php?action=tests&subaction=menage',true);



?>
