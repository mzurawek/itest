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

	$action = $vars->Get('action');
	$desturl = base64_decode($vars->Get('desturl'));
	
	session_start();
	
	
	$user = new Iuser($dbi);
	$user->Get();

	$html = new Ihtml($dbi);
	
	include("includes/template_start.php");

        $html->menu->CreateSubmenu("main",2,"","Menu g³ówne");
	$html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');
	
	if($user->logedin){
                if($action=='logout'){
                       $user->LogOut();
                       setcookie('itest_start_time','',time()-100);

                       $html->menu->Hide();
                       $html->menu->CreateSubmenu("main",2,"","Menu g³ówne");
					   $html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');

                       $html->Error(true,'Zosta³e¶ wylogowany','Zosta³e¶ wylogowany pomy¶lnie',false);
                }
                else{
					$user->Save();
					$html->Error(true,$lang['loged_already'],$lang['loged_already_message'],false);
				}
	}
	else if($action=='logout'){
		$html->menu->Hide();
        $html->menu->CreateSubmenu("main",2,"","Menu g³ówne");
		$html->menu->{'main'}->linksbox->Add(1,'Strona g³ówna','index.php');
                $html->Redirect('index.php',5);
		$html->Message($lang['go_to_index'],$lang['go_to_index_message'],$lang['go_now'],'index.php',true);
	}
	
	## Content strony...
	ob_start();
	if(strlen($action)==0){
		$tpl = new bTemplate();
		$tpl->set('desturl',base64_encode($desturl));
		$html->SetContent($tpl->fetch('template/login.tpl'));
	}
	else if($action=='login'){
			ob_start();
			include('includes/login.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
	}
	## End: content strony...



	# Wysy³anie kodu HTML do przegl±darki
	$html->Output();

?>
