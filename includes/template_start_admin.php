<?

        $panel_user_name = ($user->name == '') ? ($user->login) : ($user->name . " (". $user->login .")");


	$html->menu->CreateSubmenu("user",6,"","Panel u¿ytkownika");
	$html->menu->{'user'}->content = "<center>Zalogowany jako:<br><b>$panel_user_name</b></center><br>";
    	$html->menu->{'user'}->linksbox->Add(3,'Wyloguj siê','login.php?action=logout');


	$html->menu->CreateSubmenu("main",1,"","Menu g³ówne");
	$html->menu->{'main'}->linksbox->Add(1,'<b>Strona g³ówna</b>','index.php');

	$html->menu->CreateSubmenu("tests",3,"","Testy");
	$html->menu->{'tests'}->linksbox->Add(1,'Dodaj nowy','admin.php?action=tests&subaction=add');
	$html->menu->{'tests'}->linksbox->Add(2,'Zarz±dzaj','admin.php?action=tests&subaction=menage');

	$html->menu->CreateSubmenu("results",2,"","Wyniki");
	$html->menu->{'results'}->linksbox->Add(1,'Wy¶wietl wyniki','admin.php?action=results&subaction=class');

	$html->menu->CreateSubmenu("users",8,"","U¿ytkownicy");
	$html->menu->{'users'}->linksbox->Add(1,'Dodaj nowego','admin.php?action=users&subaction=add');
	$html->menu->{'users'}->linksbox->Add(2,'Zarz±dzaj','admin.php?action=users&subaction=menage');

	$html->menu->CreateSubmenu("classes",9,"","Klasy");
	$html->menu->{'classes'}->linksbox->Add(1,'Dodaj now±','admin.php?action=classes&subaction=add');
	$html->menu->{'classes'}->linksbox->Add(2,'Zarz±dzaj','admin.php?action=classes&subaction=menage');

	$html->menu->CreateSubmenu("grade",10,"","System oceniania");
	$html->menu->{'grade'}->linksbox->Add(1,'Edytuj','admin.php?action=grades');

	$html->menu->CreateSubmenu("help",11,"","Pomoc");
	$html->menu->{'help'}->linksbox->Add(1,'Pomoc do programu','admin.php?action=help&subaction=help');
	$html->menu->{'help'}->linksbox->Add(2,'O skrypcie','admin.php?action=help&subaction=about');
	$html->menu->{'help'}->linksbox->Add(3,'O autorze','admin.php?action=help&subaction=author');

	/*ob_start();
	#include('menu_stats.php');
		$menu_stats = ob_get_contents();
		ob_end_clean();

		$html->menu->CreateSubmenu('stats',5,'','Statystyki');
		$html->menu->{'stats'}->content = $menu_stats;*/

	$html->AddCSS('mycss.css');

?>
