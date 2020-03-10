<?
include("classes/link.php");
include("classes/linksbox.php");
include("classes/submenu.php");
include("classes/menu.php");


class Ihtml {

	var $title = 'iTests';

	var $head;

	var $content;

	var $menu;
	
	var $error = false;
	
	var $message = false;

	var $html = null;
	
	var $dbi;
	
	var $time_start = 0;
	
	var $banner1 = '';
	var $banner2 = '';
	
	//----------------------------------------------------------------------------------
	function Ihtml(&$dbi){
		$this->dbi = &$dbi;
		$this->menu = new Imenu();
		
		$this->time_start = GetMicrotime();		
	}	
	//----------------------------------------------------------------------------------
	function AddJS($filename){
		$this->head .= "
		<script language=\"JavaScript1.2\" src=\"js/$filename\" type=\"text/javascript\"></script>
		";
	}
	//----------------------------------------------------------------------------------
	function AddCSS($filename){
		$this->head .= "
		<link REL=\"stylesheet\" TYPE=\"text/css\" HREF=\"css/$filename\">
		";
	}		
	//----------------------------------------------------------------------------------
	function Redirect($url, $time = 0){
		# Doklejamy identyfikator sesji je¶li nie podany
		$ext = substr($url,strlen($url)-5,4);
		if($ext == ".php") $url .= "?PHPSESSID=" . session_id();
		if(strstr($url,'?')) $url .= "&PHPSESSID=" . session_id();
		# No i doklejamy wszystko do nag³ówka
		$this->head .= "
		<meta http-equiv=\"Refresh\" content=\"$time; URL='$url'\">
		";
	}
	//----------------------------------------------------------------------------------
	function SetContent($contet){
		if(!$this->message AND !$this->error) 
			$this->content = $contet;
	}
	//----------------------------------------------------------------------------------
	function SetTitle($title){
		$this->title .= " :: $title";
	}
	//----------------------------------------------------------------------------------
	function Generate(){
		if($this->error) return;

		$tpl = new bTemplate(); // start szablonu

			# Nag³owek
			$tpl_header = new bTemplate();
			$tpl_header->set('header_headers', $this->head);
			$tpl_header->set('title', $this->title);
			
			
			$tpl->set('header', $tpl_header->fetch('template/header.tpl'));
			
			# Stopka
			$time_end = getmicrotime();
			$time = $time_end - $time_start;
			
			$tpl_footer = new bTemplate();
			$tpl_footer->set('time', $time);
			$tpl_footer->set('dbi_count', $this->dbi->queries);
			
			$tpl->set('footer', $tpl_footer->fetch('template/footer.tpl'));
			
			# Menu
			$tpl->set('menu', $this->menu->HTMLCode());
			# Tre¶æ
			$tpl->set('content', $this->content);
			
			
			$tpl->set('server_url', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME'])  .'index.php' );
			$tpl->set('this_url', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
			

			$tpl->set('charset_xp', base64_decode("KEMpQ29weXJpZ2h0IDIwMDUgYnkgPGEgaHJlZj0iaHR0cDovL3d3dy5pbnRvbC5pbmZvIj48dT5NYXJpdXN6IK91cmF3ZWs8L3U+PC9hPi4gQWxsIHJpZ2h0cyByZXNlcnZlZC48IS0t"));

		$this->html = $tpl->fetch('template/html_template.tpl');
	}
	//----------------------------------------------------------------------------------
	function Error($die_after, $title,$message,$back = true){

		$this->SetTitle($title);

		$tpl = new bTemplate(); // start szablonu

			$tpl->set('title', $title);
			$tpl->set('message', $message);
			$tpl->set('back', $back,true);

		$this->content = $tpl->fetch('template/error.tpl');
		$this->Generate();
		$this->error = true;
		
		# Zakoñczenie wykonywania skryptu
		if($die_after){
			$this->Output();
			die();
		}
	}
	//----------------------------------------------------------------------------------
	function Output(){
		if($this->html == NULL) $this->Generate();
		echo $this->html;
	}
	//----------------------------------------------------------------------------------	
	function Message($title,$message,$link_name,$link_url,$back = true){
		$this->SetTitle($title);
		$sel_url = $link_url;
		if($link_url=='back') $sel_url = 'javascript:history.back()';
		
		$tpl = new bTemplate(); // start szablonu
		
			$tpl->set('title', $title);
			$tpl->set('message', $message);
			$tpl->set('link_name', $link_name);
			$tpl->set('link_url', $sel_url);
			$tpl->set('back', $back, true);

		$this->content = $tpl->fetch('template/message.tpl');
		
		$this->message = true;
	}
	//----------------------------------------------------------------------------------	
	# Potwierdzanie " Czy napewno chcesz ... ?" (tak) (nie)
	function Confirm($title,$message,$yes_url,$no_url){
		$this->SetTitle($title);

		$tpl = new bTemplate(); // start szablonu

			$tpl->set('title', $title);
			$tpl->set('message', $message);
			$tpl->set('yes_url', $yes_url);
			$tpl->set('no_url', $no_url);

		$this->content = $tpl->fetch('template/confirm.tpl');
		
		$this->message = true;
	}
	//----------------------------------------------------------------------------------
	function ForceLogin(){
		$this->SetTitle($GLOBALS['lang']['login_req_move']);
		
		$desturl = $_SERVER['PHP_SELF'];
		if(strlen($_SERVER['QUERY_STRING'])>=1) $desturl .= '?' . $_SERVER['QUERY_STRING'];
		$desturl = base64_encode($desturl);
		
		$this->Redirect('login.php?desturl='.$desturl,5);

		$this->Message($GLOBALS['lang']['login_req_move'],$GLOBALS['lang']['login_req_move_message'],$GLOBALS['lang']['go_now'],'login.php?desturl='.$desturl,true);
		
		$this->Generate();
		$this->error = true;
		
		# Zakoñczenie wykonywania skryptu
		$this->Output();
		die();
	}
	//----------------------------------------------------------------------------------	
}

?>
