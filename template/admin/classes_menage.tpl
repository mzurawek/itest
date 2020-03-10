<if:not_empty>
<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=7>
<font color=white><b>Zarz±dzanie klasami</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#3F6AC9" align=center width=20>
<font color=white>#</font>
</td>
<td bgcolor="#3F6AC9" align=center>
<font color=white>Nazwa klasy</font>
</td>
<td bgcolor="#3F6AC9" align=center width=50>
</td>
<td bgcolor="#3F6AC9" align=center width=50>
</td>
</tr>

<loop:classes>
<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b>&#187;</b></center></font></td>
<td bgcolor="#B8CEF3" align=left><tag:classes[].name /></td>
<td bgcolor="#B8CEF3" align=center width=50><tag:classes[].edit_link /></td>
<td bgcolor="#B8CEF3" align=center width=50><tag:classes[].delete_link /></td>
</tr>
</loop:classes>


<tr height=2>
<td class=tabbottom align=center colspan=7>
</td>
</tr>
</table>
<else:not_empty>
<center>Brak dodanych klas!</center>
</if:not_empty>
