<?
$html->SetTitle('Dodaj u¿ytkownika');
$html->SetTitle('Zapisywanie');

$login = $vars->Get('login');
$password = $vars->Get('password');
$name = $vars->Get('name');
$access = $vars->Get('access');
$class = $vars->Get('class');


$new_user = new Iuser($dbi);
$new_user->id = time() . rand(0,99);
$new_user->login = $login;
$new_user->password = md5($password);
$new_user->name = $name;
$new_user->access = $access;
$new_user->class = $class;

$query = new txtdb_SelectQuery(array('id'),'users',"\$login == '$login'");
$result = $dbi->query($query);
if($result->count() != 0) $html->Error(true,'Login zajêty','U¿ytkownik o wybranym loginie ju¿ istnieje. Wybierz inny.',true);


$query = new txtdb_InsertQuery('users',$new_user->ToArray());
$dbi->query($query);

$html->Redirect('admin.php?action=users&subaction=add',0);
$html->Message('U¿ytkownika dodano',$lang['redirect'],$lang['go_now'],'admin.php?action=users&subaction=add',true);



?>
