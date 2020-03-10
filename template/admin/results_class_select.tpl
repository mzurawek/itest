<table border="0" width=100% class=modul align=center style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=2>
<font color=white><b>Podgl±d wyników</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>

<form action="admin.php?action=results&subaction=class" ACCEPT-CHARSET="iso-8859-2" method=post>
<table width=100% class=modul>


<tr>
<td width=75>Klasa:</td>
<td>
<SELECT NAME="class_id">
<OPTION value="all"> Wszystkie klasy
<OPTION value="0"> Bez przydzielonej klasy
<loop:classes>
<OPTION value="<tag:classes[].id />"> <tag:classes[].name />
</loop:classes>
</SELECT></td>
</tr>


<tr>
<td width=75>Test:</td>
<td>
<SELECT NAME="test_id">
<loop:tests>
<OPTION value="<tag:tests[].id />"> <tag:tests[].title />
</loop:tests>
</SELECT></td>
</tr>


</table>
<br>
<br>
<center>
<input type="submit" value="Wy¶wietl wyniki">
</form>
</center>





</td></tr>
<tr height=2>
<td class=tabbottom align=center colspan=2>
</td>
</tr>
</table>

