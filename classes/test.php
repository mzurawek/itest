<?
/*IF tabela1.kolumna1 != '' THEN UPDATE(...)
[ELSE INSERT(...)]*/


	class Itest extends Iobj {
		var $id;
		var $creator_id;
		
		var $create_time = 0;
		var $title;
		
		var $desc;
		var $access;
		
		var $fill_time = 0;
		var $random_questions = false;
		var $block_after = false;
		
		var $no_crib = false;	
		
		var $dbi;
		//----------------------------------------------------------------------------------
		function Itest(&$dbi){
				$this->dbi = &$dbi;
		}		
		//----------------------------------------------------------------------------------
		function ToArray(){
			$result = array(
			'id' => $this->id, 
			'creator_id' => $this->creator_id,
			'create_time' => $this->create_time,
			'title' => $this->title,
			'desc' => $this->desc,
			'access' => $this->access,
			'fill_time' => $this->fill_time,
			'random_questions' => $this->random_questions,
			'no_crib' => $this->no_crib,
			'block_after' => $this->block_after
			);
			return $result;
		}
		//----------------------------------------------------------------------------------
		function FromArray($array){		
			$this->id = $array['id'];
			$this->creator_id = $array['creator_id'];
			$this->create_time = $array['create_time'];
			$this->title = $array['title'];
			$this->desc = $array['desc'];
			$this->access = $array['access'];
			$this->fill_time = $array['fill_time'];
			$this->random_questions = $array['random_questions'];
			$this->no_crib = $array['no_crib'];
			$this->block_after = $array['block_after'];
		}		
		//----------------------------------------------------------------------------------
		/*function HTMLCode(){
			$result = '';
			$tpl_ogloszenie = new bTemplate();
			$tpl_ogloszenie->set('ogloszenie', $this->ToArray());
			
			$result = $tpl_ogloszenie->fetch('template/ogloszenie.tpl');
			return $result;
		}*/
		//----------------------------------------------------------------------------------
		function SaveData(){
			$query = new txtdb_UpdateQuery("tests",
 	 		$this->ToArray(),"\$id == '$this->id'");
 	 		$this->dbi->query($query);
		}
		//----------------------------------------------------------------------------------
		function Load($id){
			$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib','block_after'),"tests", "\$id == '$id'",'',1);
 	 		$result = $this->dbi->query($query);
 	 		$this->FromArray($result->fetch());
		}
		//----------------------------------------------------------------------------------

	}

?>
