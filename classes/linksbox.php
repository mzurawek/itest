<?


class Ilinksbox {
	
	# Tablica link�w
	var $links = array();
	# Tablica zablokowanych link�w
	var $del_links = array();
	# Wz�r linku
	var $template_separator = "\n<br>";
	
	var $link_prefix = "\n&#187; ";
	var $link_sufix = '<br>';
	
	var $user_template = '';
	
	
	//----------------------------------------------------------------------------------
	# Konstruktor klasy
	/*function Ilinksbox(){

	}*/
	//----------------------------------------------------------------------------------
	# Funkcja dodaj�ca nowy link
	function Add($lp,$name, $url, $img_src = '', $img_width = 0, $img_height = 0){

		$link = array('lp' => $lp,'name' => $name);

		# Sprawdzanie, czy taki link ju� nie wyst�puje
		foreach($this->links as $number => $table_link){
			if($table_link['name'] == $name) return;
		}
		
		# Sprawdzanie, czy taki link nie zosta� usuni�ty
		foreach($this->del_links as $del_name){
			if($del_name == $name) return;
		}		
		
		#Je�eli wszystko gra, dodajemy link do tablicy
		$this->links[] = $link;
		
		# Tworzymy obiekt
		$this->{$name} = new Ilink();
		$this->{$name}->Set($lp,$name,$url, $img_src, $img_width, $img_height); 
		if(strlen($this->user_template)!=0) $this->{$name}->template = $this->user_template;
	}
	//----------------------------------------------------------------------------------
	# Funkcja blokuj�ca mo�liwo�� dodania konkretnego nowego linku
	function Delete($name){
		
		# Sprawdzamy na pocz�tek, czy taki element ju� nie zosta� usuni�ty
		if(in_array($name,$this->del_links)) return;
		
		# Usuwamy element z menu
		$result_table = array();
		foreach($this->links as $number => $table_link){
			if($table_link['name'] != $name) $result_table[] = $table_link;
		}		
		$this->links = $result_table;
		
		# Dodajemy element do tablicy link�w zablokowanych
		$this->del_links[] = $name;
		
		unset($this->{$name});
	}
	//----------------------------------------------------------------------------------
	# Funkcja dodaj�ca separator
	function Separator($lp){
		$link = array('lp' => $lp,'name' => 'separator', 'url' => '');
		$this->links[] = $link;
	}
	//----------------------------------------------------------------------------------
	# Funkcja dodaj�ca w�asny kod HTML
	function SelfHTMLCode($lp, $code){
		$link = array('lp' => $lp,'name' => 'selffhtmlcode', 'url' => "$code");
		$this->links[] = $link;
	}
	//----------------------------------------------------------------------------------
	#Funkcja zwracaj�ca kod HTML
	function HTMLCode(){
		$result = "";
		# P�tla wyliczaj�ca wszystkie linki
		foreach($this->links as $number => $link){
			# Sprawdzamy czy to nie separator
			if($link['name'] == 'separator'){
				$tmp_result = $this->template_separator;
			}	
			# Sprawdzamy czy u�ytkownik nie wprowadzi� w�asnego kodu
			else if($link['name'] == 'selffhtmlcode'){
				$tmp_result = $link['url'];
			}	
			# Zwyk�y link
			else{
				$tmp_result = $this->link_prefix . $this->{$link['name']}->HTMLCode() . $this->link_sufix;
			}
			
			$result .= $tmp_result;
		}
		
		return $result;
	}	
	//----------------------------------------------------------------------------------
	
	
}

?>
