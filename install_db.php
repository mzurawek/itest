<?
include("txtdb.class.php");

$result = 0;
$good_result = 9;

if(file_exists("data/itest/users.struct")) die('Baza danych jest ju� utworzona!');


#if(!txtDB::createBase('itest')) die('Nie mo�na utworzy� pliku z baz� danych!');

$dbi = new txtDB();
$dbi->connect('itest','');

$query = new txtdb_CreateQuery('users',array('id','login','password','name','class','access'));
if($dbi->query($query)) $result++;

	//tworzenie rekord�w opcji
	$query = new txtdb_InsertQuery('users',array('id' => '1', 'login' => 'twojlogin', 'password' => 'hasloMd5','name' => 'TwojaNazwa','class' => '','access' => 'admin'));
	if($dbi->query($query)) $result++;
	//koniec: tworzenie rekord�w opcji

$query = new txtdb_CreateQuery('options',array('name','value'));
if($dbi->query($query)) $result++;

	//tworzenie rekord�w opcji
	$query = new txtdb_InsertQuery('options',array('name' => 'active_test', 'value' => '0'));
	if($dbi->query($query)) $result++;
	$query = new txtdb_InsertQuery('options',array('name' => 'grades', 'value' => 'a:5:{s:7:"grade_2";i:29;s:7:"grade_3";i:49;s:7:"grade_4";i:69;s:7:"grade_5";i:90;s:7:"grade_6";i:95;}'));
	if($dbi->query($query)) $result++;
	//koniec: tworzenie rekord�w opcji


$query = new txtdb_CreateQuery('tests',array('id','creator_id', 'create_time', 'title','desc','access', 'fill_time', 'random_questions', 'no_crib', 'block_after'));
if($dbi->query($query)) $result++;


$query = new txtdb_CreateQuery('questions',array('id','test_id','question','answer1','answer2','answer3','answer4','high_level', 'correct_answer'));
if($dbi->query($query)) $result++;

$query = new txtdb_CreateQuery('classes',array('id','name'));
if($dbi->query($query)) $result++;

$query = new txtdb_CreateQuery('answers',array('id','test_id','user_id','guest_name','answers','time_start','time_end','result','result_max','percent','grade'));
if($dbi->query($query)) $result++;


if($result == $good_result) echo "Baza utworzona pomy�lnie!";
if($result < $good_result) echo "[B��d] Baza utworzona pomy�lnie, jednak kt�ra� z tabel nie mog�a zosta� utworzona...";


?>
