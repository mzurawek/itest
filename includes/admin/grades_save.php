<?

$grade_2 = $vars->Get('grade_2');
$grade_3 = $vars->Get('grade_3');
$grade_4 = $vars->Get('grade_4');
$grade_5 = $vars->Get('grade_5');
$grade_6 = $vars->Get('grade_6');


if(!ereg ('^[0-9]{1,2}$', $grade_2) OR $grade_2==0 OR $grade_2=='') $html->Error(true,'B³êdna warto¶æ','Podana przez Ciebie warto¶æ dla stopnia 2 jest b³êdna - nie zawiera tylko liczb.',true);

if(!ereg ('^[0-9]{1,2}$', $grade_3) OR $grade_3==0 OR $grade_3=='') $html->Error(true,'B³êdna warto¶æ','Podana przez Ciebie warto¶æ dla stopnia 3 jest b³êdna - nie zawiera tylko liczb.',true);

if(!ereg ('^[0-9]{1,2}$', $grade_4) OR $grade_4==0 OR $grade_4=='') $html->Error(true,'B³êdna warto¶æ','Podana przez Ciebie warto¶æ dla stopnia 4 jest b³êdna - nie zawiera tylko liczb.',true);

if(!ereg ('^[0-9]{1,2}$', $grade_5) OR $grade_5==0 OR $grade_5=='') $html->Error(true,'B³êdna warto¶æ','Podana przez Ciebie warto¶æ dla stopnia 5 jest b³êdna - nie zawiera tylko liczb.',true);

if(!ereg ('^[0-9]{1,5}$', $grade_6) OR $grade_6==0 OR $grade_6=='') $html->Error(true,'B³êdna warto¶æ','Podana przez Ciebie warto¶æ dla stopnia 6 jest b³êdna - nie zawiera tylko liczb.',true);

$grades = array('grade_2' => $grade_2, 'grade_3' => $grade_3,
'grade_4' => $grade_4, 'grade_5' => $grade_5, 'grade_6' => $grade_6);
$s_grades = serialize($grades);

$query = new txtdb_UpdateQuery('options',array('value' => $s_grades),"\$name == 'grades'");
$dbi->query($query);

$html->Redirect("admin.php?action=grades",5);
$html->Message($lang['operation_success'],$lang['redirect'],$lang['go_now'],"admin.php?action=grades",true);

?>
