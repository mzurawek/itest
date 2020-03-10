<?



class Isubmenu {

	var $title;
	var $content;
	
	var $template;
	var $template_obj;
	
	var $linksbox;
	
	var $show = true;
	
	function Isubmenu($template = '', $title=''){
		$this->title = $title;
		$this->template = $template;
		$this->template_obj = new bTemplate();
		$this->linksbox = new Ilinksbox();
	}
	
	function HTMLCode(){
		$master_tpl = new bTemplate();
		
		//title
		$show_title = false;
		if($this->title!='') $show_title = true;
		//content
		/*if($template != ''){
			$this->Set('linksbox',$this->linksbox->HTMLCode());
			$this->content = $this->template_obj->fetch($this->template);
		}*/
		$linksbox_code = $this->linksbox->HTMLCode();
		$show_linksbox = true;
		if(strlen($linksbox_code)==0) $show_linksbox = false;
		$master_tpl->set('linksbox',$linksbox_code);
		$master_tpl->set('show_linksbox',$show_linksbox,true);
		
		$master_tpl->set('show_title',$show_title,true);
		$master_tpl->set('title',$this->title);
		$master_tpl->set('content',$this->content);	
		if($this->show)
		return $master_tpl->fetch('template/html_submenu.tpl');
		else return '';
	}
	
	function Set($name, $value, $if=false){
		$this->template_obj->set($name,$value,$if);
	}
	

}

?>
