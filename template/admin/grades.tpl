<SCRIPT LANGUAGE="JavaScript">
<!--
function checkform ( form )
{
 if((parseInt(form.grade_2.value) >= parseInt(form.grade_3.value)) || (parseInt(form.grade_3.value) >= parseInt(form.grade_4.value)) || (parseInt(form.grade_4.value) >= parseInt(form.grade_5.value)) || (parseInt(form.grade_5.value) >= parseInt(form.grade_6.value)) || (parseInt(form.grade_5.value) > 100) || (parseInt(form.grade_2.value) <= 0)){
 alert('Wpisane przez Ciebie dane wydaj± siê nie mieæ sensu. Spróbuj je ponownie przeanalizowaæ.')
 return false
 }
 return true

}
//-->
</SCRIPT>



<table border="0" width=100% class=modul align=center style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=2>
<font color=white><b>Edytuj system oceniania</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>


<form name="gradesForm" action="admin.php?action=grades&subaction=save" ACCEPT-CHARSET="iso-8859-2" method=post onsubmit="return checkform(this);">
<table width=100% class=modul>

<tr>
<td width=30 align=center><input type="text" name="grade_2" style="width:30px" value="<tag:grades.grade_2 />"></td>
<td>minimalny % punktów z testu dla oceny <b>2</b></td>
</tr>
<tr>
<td width=30 align=center><input type="text" name="grade_3" style="width:30px" value="<tag:grades.grade_3 />"></td>
<td>minimalny % punktów z testu dla oceny <b>3</b></td>
</tr>
<tr>
<td width=30 align=center><input type="text" name="grade_4" style="width:30px" value="<tag:grades.grade_4 />"></td>
<td>minimalny % punktów z testu dla oceny <b>4</b></td>
</tr>
<tr>
<td width=30 align=center><input type="text" name="grade_5" style="width:30px" value="<tag:grades.grade_5 />"></td>
<td>minimalny % punktów z testu dla oceny <b>5</b></td>
</tr>
<tr>
<td width=30 align=center><input type="text" name="grade_6" style="width:30px" value="<tag:grades.grade_6 />"></td>
<td>minimalny % punktów z testu dla oceny <b>6</b></td>
</tr>
<tr>
<td align=center colspan=2><i>
<br>
Je¿eli chcesz zablokowaæ mo¿liwo¶æ oceny testu na 6, wprowad¼ minimaln± warto¶æ % punktów z testu dla tej oceny powy¿ej 100 %.</i></td>
</tr>

</table>
<br>
<br>
<center>
<input type="submit" value="Zapisz zmiany">
</form>
</center>


</td></tr>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=2>
</td>
</tr>
</table>
