<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=1>
<font color=white><b>Edytuj uzytkownika</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>


<form action="admin.php?action=users&subaction=edit_save&id=<tag:user.id />&old_password=<tag:user.password />" ACCEPT-CHARSET="iso-8859-2" method=post>
<table width=100% class=modul>

<tr>
<td width=110>Login:</td>
<td><input type="text" name="user_login" style="width:300px" value="<tag:user.login />"></td>
</tr>


<tr>
<td width=110>Has³o:</td>
<td><input type="password" name="user_password" style="width:150px"> (wype³nij tylko w razie chêci zmiany)</td>
</tr>

<tr>
<td width=110>Imiê i nazwisko:</td>
<td><input type="text" name="name" style="width:300px" value="<tag:user.name />"></td>
</tr>

<if:is_admin>
<tr>
<td width=110>Uprawnienia:</td>
<td>
<SELECT NAME="access" style="width:100px">
<OPTION value="user"> U¿ytkownik
<OPTION value="admin" selected> Administrator
</SELECT></td>
</tr>
<else:is_admin>
<tr>
<td width=110>Uprawnienia:</td>
<td>
<SELECT NAME="access" style="width:100px">
<OPTION value="user"> U¿ytkownik
<OPTION value="admin"> Administrator
</SELECT></td>
</tr>
</if:is_admin>

<tr>
<td width=110>Klasa:</td>
<td>
<SELECT NAME="class" style="width:100px">
<OPTION value=""> Brak
<loop:classes>
<OPTION value="<tag:classes[].id />" <tag:classes[].selected />> <tag:classes[].name />
</loop:classes>
</SELECT></td>
</tr>



</table>
<br>
<br>
<center>
<input type="submit" value="Zapisz zmiany">
</center>
</form>

</td></tr>
<tr height=2>
<td class=tabbottom align=center colspan=1>
</td>
</tr>
</table>
