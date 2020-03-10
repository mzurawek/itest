<center>Tytul testu: <b><tag:test.title /></b></center>
<br><br>

<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=7>
<font color=white><b>Wyniki</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#3F6AC9" align=center width=20>
<font color=white>#</font>
</td>
<td bgcolor="#3F6AC9" align=center>
<font color=white>Nazwa osoby testowanej</font>
</td>
<td bgcolor="#3F6AC9" align=center width=70>
<font color=white>Punkty</font>
</td>
<td bgcolor="#3F6AC9" align=center width=50>
<font color=white>%</font>
</td>
<td bgcolor="#3F6AC9" align=center width=50>
<font color=white>Ocena</font>
</td>
<td bgcolor="#3F6AC9" align=center width=70>
</td>
<td bgcolor="#3F6AC9" align=center width=40>
</td>
</tr>

<loop:answers>
<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b>&#187;</b></center></font></td>
<td bgcolor="#B6C9F1" align=left><tag:answers[].user_name /></td>
<td bgcolor="#B6C9F1" align=center><tag:answers[].result /> / <tag:answers[].result_max /></td>
<td bgcolor="#B6C9F1" align=center><tag:answers[].percent /> %</td>
<td bgcolor="#B6C9F1" align=center><tag:answers[].grade /></td>


<td bgcolor="#B6C9F1" align=center width=120><tag:answers[].show_answers_link /></td>
<td bgcolor="#B6C9F1" align=center width=40><tag:answers[].delete_link /></td>
</tr>
</loop:answers>


<tr height=2>
<td class=tabbottom align=center colspan=7>
</td>
</tr>
</table>

