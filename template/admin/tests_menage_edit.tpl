<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption align=center colspan=2>
<font color=white><b>Edytuj test</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>


<form action="admin.php?action=tests&subaction=menage_edit_save&test_id=<tag:test.id />" ACCEPT-CHARSET="iso-8859-2" method=post>
<table width=100% class=modul>
<tr>
<td width=90>Tytu³ testu:</td>
<td><input type="text" name="title" style="width:500px" value="<tag:test.title />"></td>
</tr>
<tr>
<td width=90>Dodatkowa adnotacja:</td>
<td><textarea rows=4 name="desc" style="width:500px"><tag:test.desc /></textarea></td>
</tr>


<tr>
<td width=90>Dostêp do testu:</td>
<td>
<SELECT NAME="access">
<OPTION value="1" <tag:test.access_1_checked />> Tylko administratorzy
<OPTION value="2" <tag:test.access_2_checked />> Tylko u¿ytkownicy zalogowani
<OPTION value="3" <tag:test.access_3_checked />> Wszyscy
</SELECT>
</td>
</tr>


<tr>
<td width=90 align=center><input type="text" name="fill_time" value="<tag:test.fill_time />" style="width:50px"></td>
<td>ograniczenie czasowe wype³niania testu (w minutach)</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="random_questions" <tag:test.random_questions_checked />></td>
<td>wyswietlaj pytania w losowej kolejnosci</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="block_after" <tag:test.block_after_checked />></td>
<td>blokuj test na 5 minut po jego wypelnieniu</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="no_crib" <tag:test.no_crib_checked />></td>
<td>aktywuj system zapobiegajacy sciaganiu</td>
</tr>

</table>
<br>
<center>
<input type="submit" value="Zapisz zmiany">
</center>
</form>

</td></tr>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=2>
</td>
</tr>
</table>
