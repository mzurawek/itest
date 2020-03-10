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

	#$main_page = true;
	#include("includes/template_start.php");
        $html->title = 'iTest';
	$html->AddCSS('mycss.css');

	ob_start();
	
	
	# G³owny szablon contentu
	$tpl = new bTemplate();
	##Content strony
	## End: content strony...
	if(!is_writable('data/itest/users.struct'))
        	$html->Error(true,'Brak mozliwosci zapisu','Brak mozliwosci zapisu do bazy. Jezeli skrypt dziala na serwerze linuxowym, musisz nadac prawa CHMOD na poziomie 666 wszystkim plikom w katalogu /data/itest/.',false);
	
	
	$html->menu->CreateSubmenu("welcome",1,"","Witaj");
	$html->menu->{'welcome'}->content = "<center>Witaj w <b>iTest</b>!</center><br><font size=-2>System s³u¿y do efektywnego przeprowadzania testów.</font>";
    	
	# Generowanie g³ownego szablonu			
	if(!$user->logedin) $html->SetContent($tpl->fetch('template/main.tpl'));
	else
	{
            $tpl->set('user_name',($user->name == '') ? ($user->login) : ($user->name . " (". $user->login .")"));
            $tpl->set('is_admin',($user->access == 'admin') ? (true) : (false),true);
            $html->SetContent($tpl->fetch('template/main_logedin.tpl'));
        }
	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	$user->Save();

	# Wysy³anie kodu HTML do przegladarki
	$html->Output();

?>
