<if:not_empty>
<loop:users>
<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b>&#187;</b></center></font></td>
<td  bgcolor="#B8CEF3" align=left width=160><tag:users[].login /></td>
<td  bgcolor="#B8CEF3" align=left><tag:users[].name /></td>
<td  bgcolor="#B8CEF3" align=center width=100><tag:users[].access_text /></td>
<td  bgcolor="#B8CEF3" align=center width=50><tag:users[].edit_link /></td>
<td  bgcolor="#B8CEF3" align=center width=50>&nbsp;<tag:users[].delete_link /></td>
</tr>
</loop:users>
<else:not_empty>
<tr height=2>
<td bgcolor="#B8CEF3" align=center colspan=6>
Brak dodanych u¿ytkowników
</td>
</tr>
</if:not_empty>
