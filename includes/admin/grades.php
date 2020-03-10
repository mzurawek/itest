<?
$html->SetTitle('System oceniania');

	$query = new txtdb_SelectQuery(array('value'),'options',"\$name == 'grades'");

	$result = $dbi->query($query);
	$record = $result->fetch();
	$grades = unserialize($record['value']);


$sub_tpl = new bTemplate();
$sub_tpl->set('grades',$grades);
echo $sub_tpl->fetch('template/admin/grades.tpl');

$grades = array('grade_2' => 29,'grade_3' => 49,'grade_4' => 69,'grade_5' => 90,'grade_6' => 95);

?>
