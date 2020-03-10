<?

class Iimg{
	var $src = '';
	var $width = 0;
	var $height = 0;
	
	var $show = true;
	
	//----------------------------------------------------------------------------------
	function HTMLCode(){
		$result = '';
		
		if($this->src != '' AND $this->show == true)
			$result = "<img src=\"$this->src\" border=0 width=\"$this->width\" height=\"$this->height\">";
		
		return $result;
	}
	//----------------------------------------------------------------------------------
	function ToArray(){
		$result = array('src' => $this->src,'width' => $this->width,'height' => $this->height);
		return $result;
	}
	
	
}

?>
