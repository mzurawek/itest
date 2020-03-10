<?
$html->SetTitle('Edytuj uzytkownika');
$html->SetTitle('Zapisywanie');

$id = $vars->Get('id');
$login = $vars->Get('user_login');
$password = $vars->Get('user_password');
$old_password = $vars->Get('old_password');
$name = $vars->Get('name');
$access = $vars->Get('access');
$class = $vars->Get('class');


$new_user = new Iuser($dbi);
$new_user->id = $id;
$new_user->login = $login;
$new_user->password = (strlen($password)!=0) ? (md5($password)) : ($old_password);
$new_user->name = $name;
$new_user->access = $access;
$new_user->class = $class;

if($id == $user->id)
{
if($new_user->access == 'user') $html->Error(true,'Blad','Nie mozesz sam sobie cofnac praw administratora!',true);
$user = $new_user;
$user->Save();
}

$query = new txtdb_SelectQuery(array('id'),'users',"\$login == '$login' AND \$id != '$id'");
$result = $dbi->query($query);
if($result->count() != 0) $html->Error(true,'Login zajêty','U¿ytkownik o wybranym loginie ju¿ istnieje. Wybierz inny.',true);


$query = new txtdb_UpdateQuery('users',$new_user->ToArray(),"\$id == '$id'");
$dbi->query($query);


$html->Redirect('admin.php?action=users&subaction=menage',0);
$html->Message('U¿ytkownika edytowano pomyslnie',$lang['redirect'],$lang['go_now'],'admin.php?action=users&subaction=menage',true);



?>
