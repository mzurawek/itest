<?

$login = $vars->Get('login');
$password = $vars->Get('password');


$autologin = $vars->Get('autologin');
if($autologin=='yes') $autologin = true;
else $autologin = false;


# Logowanie

$user->LogIn($login,md5($password));
# Logowanie NIE powiod³o siê
if($user->logedin == false){
                      $html->menu->Hide();
                      $html->menu->CreateSubmenu("main",2,"","Menu g³ówne");
					   $html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');

	$html->Error(true,$lang['login_failed'],$lang['login_failed_message'],true);
}


$cookie_action = 'none';
if($autologin) $cookie_action = 'save';
$user->Save($cookie_action);

if(strlen($desturl) == 0) $tmp_url = 'index.php';
else $tmp_url = $desturl;

$html->Message($lang['login_done'],$lang['login_done_message'],$lang['go_now'],$tmp_url,true);
$html->Redirect($tmp_url,0);

?>
