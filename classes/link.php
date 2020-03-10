<?

class Ilink {
	
	var $lp = 0;
	var $name = '';
	var $url = '';
	
	var $img;
	
	var $template = "<a href=\"{url}\" class=modul>{name}</a>";
	
	//----------------------------------------------------------------------------------
	function Ilink(){
		$this->img = new Iimg();
	}
	//----------------------------------------------------------------------------------
	function Set($lp, $name, $url, $img_src = '', $img_width = 0, $img_height = 0){
		$this->lp = $lp;
		$this->name = $name;
		$this->url = $url;
		$this->img->src = $img_src;
		$this->img->width = $img_width;
		$this->img->height = $img_height;
	}
	//----------------------------------------------------------------------------------
	function HTMLCode(){
		$result = '';
		
		$img_code = $this->img->HTMLCode();
		if($img_code) 
			$result .= $img_code . ' ';
		
		if($this->url != ''){
			$link_code = $this->template;
			$link_code = str_replace('{url}',$this->url,$link_code);
			$link_code = str_replace('{name}',$this->name,$link_code);
			$result .= $link_code;
		}
		
		return $result;
	}
	//----------------------------------------------------------------------------------
}

?>
