<?

class Iobj{
	
	var $dbi;
	
	//----------------------------------------------------------------------------------
	function SetDbi(&$dbi){
		$this->dbi = &$dbi;
	}
	//----------------------------------------------------------------------------------
	function Var2Base($varible){
		$varible = str_replace('-;-','-;;-',$varible);
		$varible = str_replace("'",'-;-',$varible);
		return $varible;
	}
	//----------------------------------------------------------------------------------
	function Base2Var($varible){
		$varible = str_replace('-;-',"'",$varible);
		$varible = str_replace('-;;-','-;-',$varible);
		return $varible;		
	}
	//----------------------------------------------------------------------------------	
	
}

?>
