<?
	# Czas generowania
	function GetMicrotime(){ 
    	list($usec, $sec) = explode(" ",microtime()); 
    	return ((float)$usec + (float)$sec); 
    }    
?>
