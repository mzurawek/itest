<table width="95%" style="border: 0.3mm solid #376BD9" class=modul align=center>
<tr><td class=tabcaption class=tabcaption colspan=3>
<center><b>Wyniki testu</b></center>
</td></tr>
<tr>
<td align=left bgcolor="#B8CEF3" >
Tytu³ testu: "<tag:test.title />".<br><br>
Czas pisania testu: <tag:day> od godz. <tag:start_time_text /> do <tag:end_time_text />.<br><br>
Wyniki dla: <b><tag:user_name /></b><br>
Ilo¶æ punktów: <b><tag:result /></b> / <b><tag:result_max /></b> (<tag:percent />%)<br>
Ocena: <b><tag:grade /></b>
</td>
</tr>
<tr height=2>
<td class=tabbottom colspan=3 align=center>
</td>
</tr>
</table>
<br><br>

<if:show_answers>
<table width="95%" bgcolor="#B8CEF3" style="border: 0.3mm solid #376BD9" class=modul align=center>
<tr><td bgcolor="#376BD9" class=tabcaption colspan=3>
<center><b>Odpowiedzi u¿ytkownika</b></center>
</td></tr>


<loop:questions_and_answers>
<tr>
<td align=left width=85>Pytanie: </td>
<td><b><tag:questions_and_answers[].question /></b></td>
</tr>
<tr>
<td align=left width=85>Odpowied¼: </td>
<td><tag:questions_and_answers[].answer /></td>
</tr>
</loop:questions_and_answers>


<tr height=2>
<td class=tabbottom colspan=3 align=center>
</td>
</tr>
</table>
</if:show_answers>
