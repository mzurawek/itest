<?
/* 
Klasa Tvar
(C)Copyright 2004 by Mariusz ¯urawek
All rights reserved
*/

class Ivar { 
	//----------------------------------------------------------------------------------
 	function GetPost($name, $level = 1){
 		$var = $_POST[$name];
 		if(strlen($var)==0) $var = null;
 		return $this->MakeSafe($var,$level);
 	}
 	//----------------------------------------------------------------------------------
 	function Get($name, $level = 1) /*get - post&get*/{
 		$var = $_GET[$name];
 		if(strlen($var)==0){
 			$var = $_POST[$name];
  			if(strlen($var)==0) return null;
  			else return $this->MakeSafe($var,$level);
 		}
 		else{
 			return $this->MakeSafe($var,$level);
 		}		
 	}
 	//----------------------------------------------------------------------------------
	function MakeSafe($var, $level = 1 /*d. najwy¿szy poziom bezpieczeñstwa*/) { 
		
		if(strlen($var)==0) return null;
		
		if($level==0){ /* zwyk³e zmienne (np. liczby i nazwiska)*/
			return $var;
		}		
		if($level==1){ /* zwyk³e zmienne (np. liczby i nazwiska)*/
			$var = stripslashes($var);
			$var =  ereg_replace("\n|\r|\"|'|\\|<|>", "", $var);
			$var = trim($var);
			
			return $var;
		}
		else if($level==2){ /* jedno-liniowe ³añcuchy znakowe*/
			$var = stripslashes($var);
			$var =  ereg_replace("\n|\r", '', $var);
			$var = str_replace('"', '&quot;', $var);
			$var = str_replace('<', '&lt;', $var);
			$var = str_replace('>', '&gt;', $var);
			$var = trim($var);
		
			return $var;
		}
		else if($level==3){ /* wielo-liniowe ³añcuchy znakowe*/
			$var = stripslashes($var);
			$var = str_replace('"', '&quot;', $var);
			$var = str_replace('<', '&lt;', $var);
			$var = str_replace('>', '&gt;', $var);
			$var = str_replace("\r", '', $var);
			$var = str_replace("\n", '<br>', $var);
			$var = trim($var);
			
			return $var;
		}	
		else if($level==4){ /* czysty */
			$var = stripslashes($var);
			return $var;
		}			
		else{
			die("Var::MakeSafe::B³êdne wywo³anie funkcji");
		}
		return null;
	} 
	//----------------------------------------------------------------------------------

} #class Tvar
?>
