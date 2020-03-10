<?
$html->SetTitle('Zarzadzanie klasami');


	$classes = array();

	$query = new txtdb_SelectQuery(array('id','name'),'classes');
	$result = $dbi->query($query);
	while($record = $result->fetch())
	{
		$class = $record;
		$class['edit_link'] = "<a href=\"admin.php?action=classes&subaction=edit&id=".$class['id']."\">Edytuj</a>";
		$class['delete_link'] = "<a href=\"admin.php?action=classes&subaction=delete&id=".$class['id']."\">Usuñ</a>";
		$classes[] = $class;
	}
	$not_empty = !empty($classes);

$sub_tpl = new bTemplate();
$sub_tpl->set('classes',$classes,true);
$sub_tpl->set('not_empty',$not_empty,true);
echo $sub_tpl->fetch('template/admin/classes_menage.tpl');

?>
