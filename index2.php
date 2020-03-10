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
	$user->LogOut();
	

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
	$html->menu->{'welcome'}->content = "<center>Witaj w <b>iTest</b>!</center><br><font size=-2>System s³u¿y do  przeprowadzania testów.</font>";
    	
    	
    	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'active_test'");
	$result = $dbi->query($query);
	$record = $result->fetch();
	$active_test_id = $record['value'];
	
	$test = new Itest($dbi);

	$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib','block_after'),'tests',"\$id == '$active_test_id'");
	$result = $dbi->query($query);
	$test->FromArray($result->fetch());
    	
        $tpl->set('test',$test->ToArray());
	# Generowanie g³ownego szablonu			
	$html->SetContent($tpl->fetch('template/main2.tpl'));

	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	$user->Save();

	# Wysy³anie kodu HTML do przegladarki
	$html->Output();

?>
