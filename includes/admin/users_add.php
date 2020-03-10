<?
$html->SetTitle('Dodaj u¿ytkownika');

$query = new txtdb_SelectQuery(array('id','name'),'classes');
$result = $dbi->query($query);
	$classes = array();
	while($record = $result->fetch())
	{
		$record['selected'] = 'selected';
		$classes[] = $record;
	}

$tpl_ads = new bTemplate();
$tpl_ads->set('classes',$classes,true);
echo $tpl_ads->fetch('template/admin/users_add.tpl');

?>
