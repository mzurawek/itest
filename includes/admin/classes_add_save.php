<?
$html->SetTitle('Dodawanie nowej klasy');
$html->SetTitle('Zapisywanie');

$id = time() . rand(0,99);
$name = $vars->Get('name');

$query = new txtdb_InsertQuery('classes',array('id' => $id, 'name' => $name));
$dbi->query($query);

$html->Redirect('admin.php?action=classes&subaction=menage',0);
$html->Message('Klasê dodano',$lang['redirect'],$lang['go_now'],'admin.php?action=classes&subaction=menage',true);



?>


