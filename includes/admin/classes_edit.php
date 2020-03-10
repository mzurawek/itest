<?
$html->SetTitle('Zarz±dzanie klasami');
$html->SetTitle('Edycja');

$id = $vars->Get('id');

$query = new txtdb_SelectQuery(array('id', 'name'),'classes',"\$id == '".$id."'");
$result = $dbi->query($query);
$class = $result->fetch();

$sub_tpl = new bTemplate();
$sub_tpl->set('class',$class);
echo $sub_tpl->fetch('template/admin/classes_edit.tpl');

?>
