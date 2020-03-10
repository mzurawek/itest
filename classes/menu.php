<?

class Imenu{
	
	var $submenus = array(/*0 => 'menu_ogloszenia', 20 => 'menu_szukaj'*/);
	
	# Dodatkowy tekst na pocz±tku menu
	var $additional_text_start = '';
	# Dodatkowy tekst na koñcu menu
	var $additional_text_end = '';
	
	
	//----------------------------------------------------------------------------------
	# Funkcja tworz±ca nowe submenu
	function CreateSubmenu($name,$lp, $template, $title){
		//'templates/menu/ogloszenia.tpl'
		# Dynamicznie tworzymy nowe submenu
		$this->{$name} = new Isubmenu($template,$title);
		# Dodajemy je do tablicy, ¿eby je zapamiêtaæ
		$this->submenus[$lp] = $name;
	}
	//----------------------------------------------------------------------------------
	# Funkcja odpowiedzialna za chowanie wszystkich submenu	
	function Hide(){
		# Wyliczanie wszystkich submenu
		foreach($this->submenus as $number => $submenu){
			# Sprawdzanie czy menu jest widoczne
			$this->{$submenu}->show = false;
		}		
	}	
	//----------------------------------------------------------------------------------
	# Funkcja odpowiedzialna za chowanie wszystkich submenu	
	function Show(/*array*/ $submenus){
		# Je¿eli zmienna NIE jest menu
		if(!is_array($submenus)){
			$this->{$submenus}->show = true;
		}
		# Zmienna to tablica
		else{
			# Wyliczanie wszystkich submenu i zmiana ich warto¶ci
			foreach($submenus as $number => $submenu){
				# Sprawdzanie czy menu jest widoczne
				$this->{$submenu}->show = true;
			}		
		}
	}	
	//----------------------------------------------------------------------------------
	# Funkcja zwracaj±ca kod HTML menu
	function HTMLCode(){
		$result = '';
		# G³owny szablon menu
		$master_tpl = new bTemplate();
		
		# Zmienna z kodem wszystkich submenu
		$submenus = ''; 
		# Wyliczanie wszystkich submenu
		foreach($this->submenus as $number => $submenu){
			# Sprawdzanie czy menu jest widoczne
				$submenus .= $this->{$submenu}->HTMLCode();
		}
		
		$master_tpl->set('submenus', $submenus);
		$master_tpl->set('additional_text_start', $this->additional_text_start);
		$master_tpl->set('additional_text_end', $this->additional_text_end);
		
		$result = $master_tpl->fetch('template/html_menu.tpl');
		
		return $result;
	}
	//----------------------------------------------------------------------------------		
	
}


?>
