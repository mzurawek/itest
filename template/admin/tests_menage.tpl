<if:not_empty>
<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption align=center colspan=8>
<font color=white><b><center>Zarz±dzanie testami</center></b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#3F6AC9" align=center width=20>
<font color=white>#</font>
</td>
<td bgcolor="#3F6AC9" align=center>
<font color=white>Tytu³</font>
</td>
<td bgcolor="#3F6AC9" align=center width=140>
<font color=white>Czas utworzenia</font>
</td>
<td bgcolor="#3F6AC9" align=center width=110>
</td>
<td bgcolor="#3F6AC9" align=center width=70>
</td>
<td bgcolor="#3F6AC9" align=center width=40>
</td>
<td bgcolor="#3F6AC9" align=center width=50>
</td>
<td bgcolor="#3F6AC9" align=center width=70>
</td>
</tr>
<loop:tests>
<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b>&#187;</b></center></font></td>
<td  bgcolor="#B8CEF3" align=left><tag:tests[].title /></td>
<td  bgcolor="#B8CEF3" align=center width=140><tag:tests[].time_create_text /></td>
<td  bgcolor="#B8CEF3" align=center width=110><a href="admin.php?action=questions&subaction=menage&test_id=<tag:tests[].id />">Edytuj pytania</a></td>
<td  bgcolor="#B8CEF3" align=center width=70><a href="admin.php?action=tests&subaction=menage_edit&test_id=<tag:tests[].id />">Ustawienia</a></td>
<td  bgcolor="#B8CEF3" align=center width=40><a href="admin.php?action=tests&subaction=menage_delete&test_id=<tag:tests[].id />">Usuñ</a></td>
<td  bgcolor="#B8CEF3" align=center width=50><a href="print.php?test_id=<tag:tests[].id />">Drukuj</a></td>
<td  bgcolor="#B8CEF3" align=center width=70><tag:tests[].activate_link /></td>
</tr>
</loop:tests>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=8>
</td>
</tr>
</table>
<else:not_empty>
<center>Brak dodanych testów!</center>
</if:not_empty>
