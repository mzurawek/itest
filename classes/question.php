<?

/*IF tabela1.kolumna1 != '' THEN UPDATE(...)
[ELSE INSERT(...)]*/


	class Iquestion extends Iobj {
		var $id;
		var $test_id;
		
		#var $answers;
		
		var $answer1;
		var $answer2;
		var $answer3;
		var $answer4;
		
		var $question;
		var $correct_answer;
		
		var $high_level;
		
		var $dbi;
		//----------------------------------------------------------------------------------
		function Itest(&$dbi){
				$this->dbi = &$dbi;
		}		
		//----------------------------------------------------------------------------------
		function ToArray(){
			$result = array(
			'id' => $this->id, 
			'test_id' => $this->test_id,
			'answer1' => $this->answer1,
			'answer2' => $this->answer2,
			'answer3' => $this->answer3,
			'answer4' => $this->answer4,
			'question' => $this->question,
			'correct_answer' => $this->correct_answer,
			'high_level' => $this->high_level
			#'answers' => $this->SerializeAnswers()
			);
			return $result;
		}
		//----------------------------------------------------------------------------------
		function FromArray($array){		
			$this->id = $array['id'];
			$this->test_id = $array['test_id'];
			$this->answer1 = $array['answer1'];
			$this->answer2 = $array['answer2'];
			$this->answer3 = $array['answer3'];
			$this->answer4 = $array['answer4'];
			$this->question = $array['question'];
			$this->correct_answer = $array['correct_answer'];
			$this->high_level = $array['high_level'];
		}		
		//----------------------------------------------------------------------------------
		function SetAnswers($answers){
			$answers_array = unserialize($answers);
			$this->answer1 = $answers_array['answer1'];
			$this->answer2 = $answers_array['answer2'];
			$this->answer3 = $answers_array['answer3'];
			$this->answer4 = $answers_array['answer4'];	
		}
		//----------------------------------------------------------------------------------
		function SerializeAnswers(){
			$answers['answer1'] = $this->answer1;
			$answers['answer2'] = $this->answer2;
			$answers['answer3'] = $this->answer3;
			$answers['answer4'] = $this->answer4;
			
			return serialize($answers);
		}
		//----------------------------------------------------------------------------------
		/*function SaveData(){
			$query = new txtdb_UpdateQuery("tests",
 	 		$this->ToArray(),"\$id == '$this->id'");
 	 		$this->dbi->query($query);
		}
		//----------------------------------------------------------------------------------
		function Load($id){
			$query = new txtdb_SelectQuery(array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib'),"tests", "\$id == '$id'",'',1);
 	 		$result = $this->dbi->query($query);
 	 		$this->FromArray($result->fetch());
		}*/
		//----------------------------------------------------------------------------------

	}

?>