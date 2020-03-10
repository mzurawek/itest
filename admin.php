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
	$subaction = $vars->Get('subaction');
	include("includes/template_start_admin.php");

	ob_start();

	if($user->logedin){
		if($user->access != 'admin') die('Panel administratora jest niedostêpny dla zwyk³ego u¿ytkownika!');
	}
	else $html->ForceLogin();
	
 	# Jak u¿ytkownik jest ju¿ tu, to znaczy ¿e jest zalogowanym administartorem
	
	$html->SetTitle('Panel Administracyjny');
	
	if(strlen($action)==0){
		        ob_start();
			include('includes/admin/main.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
                }
	else if($action=='tests'){
		if($subaction=='add'){
			ob_start();
			include('includes/admin/tests_add.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		if($subaction=='add_save'){
			ob_start();
			include('includes/admin/tests_add_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		if($subaction=='menage'){
			ob_start();
			include('includes/admin/tests_menage.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}		
		if($subaction=='menage_edit'){
			ob_start();
			include('includes/admin/tests_menage_edit.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		if($subaction=='menage_edit_save'){
			ob_start();
			include('includes/admin/tests_menage_edit_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		if($subaction=='menage_delete'){
			ob_start();
			include('includes/admin/tests_menage_delete.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		if($subaction=='activate'){
			ob_start();
			include('includes/admin/tests_activate.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
	}
	else if($action=='classes'){
		
		if($subaction=='add'){
			ob_start();
			include('includes/admin/classes_add.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='add_save'){
			ob_start();
			include('includes/admin/classes_add_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='menage'){
			ob_start();
			include('includes/admin/classes_menage.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		else if($subaction=='edit'){
			ob_start();
			include('includes/admin/classes_edit.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}		
		else if($subaction=='edit_save'){
			ob_start();
			include('includes/admin/classes_edit_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='delete'){
			ob_start();
			include('includes/admin/classes_delete.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
	}
	else if($action=='grades'){
		
		if(strlen($subaction)==0){
			ob_start();
			include('includes/admin/grades.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='save'){
			ob_start();
			include('includes/admin/grades_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
	}
	else if($action=='help'){
		if($subaction=='about'){
			ob_start();
			
			$html->SetTitle('O programie');
			$sub_tpl = new bTemplate();
			echo $sub_tpl->fetch('template/admin/about.tpl');
			
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		else if($subaction=='author'){
			ob_start();
			
			$html->SetTitle('O autorze');
			$sub_tpl = new bTemplate();
			echo $sub_tpl->fetch('template/admin/author.tpl');
			
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		else if($subaction=='help'){
			ob_start();
			
			$html->SetTitle('Pomoc');
			$sub_tpl = new bTemplate();
			echo $sub_tpl->fetch('template/admin/help.tpl');
			
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}		
		
		
	}
	else if($action=='results'){
		$html->SetTitle('Wyniki');
		if($subaction=='class'){
			ob_start();
			include('includes/admin/results_class.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		/*else if($subaction=='student'){
			ob_start();
			include('includes/admin/results_student.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}*/	
		else if($subaction=='delete'){
			ob_start();
			include('includes/admin/results_delete.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		
	}
	else if($action=='users'){
		$html->SetTitle('Menad¿er u¿ytkowników');
		if($subaction=='add'){
			ob_start();
			include('includes/admin/users_add.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		if($subaction=='add_save'){
			ob_start();
			include('includes/admin/users_add_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		if($subaction=='menage'){
			ob_start();
			include('includes/admin/users_menage.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		if($subaction=='delete'){
			ob_start();
			include('includes/admin/users_delete.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		if($subaction=='edit'){
			ob_start();
			include('includes/admin/users_edit.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		if($subaction=='edit_save'){
			ob_start();
			include('includes/admin/users_edit_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
	}
	else if($action=='questions'){
		$html->SetTitle('Pytania');
		$test_id = $vars->Get('test_id');
				
		if($subaction=='add_save'){
			ob_start();
			include('includes/admin/questions_add_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}
		else if($subaction=='menage'){
			ob_start();
			include('includes/admin/questions_menage.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='edit'){
			ob_start();
			include('includes/admin/questions_edit.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='edit_save'){
			ob_start();
			include('includes/admin/questions_edit_save.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
		else if($subaction=='delete'){
			ob_start();
			include('includes/admin/questions_delete.php');
			$html->SetContent(ob_get_contents());
			ob_end_clean();
		}	
	}
	# Je¿eli u¿ytkownik jest zalogowany, zapisuje go w sesji
	if($user->logedin) $user->Save();

	# Wysy³anie kodu HTML do przegl¹darki
	$html->Output();

?>
