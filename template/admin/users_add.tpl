<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td class=tabcaption align=center colspan=1>
<font color=white><b>Dodaj uzytkownika</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>


<form action="admin.php?action=users&subaction=add_save" ACCEPT-CHARSET="iso-8859-2" method=post>
<table width=100% class=modul>

<tr>
<td width=110>Login:</td>
<td><input type="text" name="login" style="width:300px"></td>
</tr>


<tr>
<td width=110>Has³o:</td>
<td><input type="password" name="password" style="width:300px"></td>
</tr>

<tr>
<td width=110>Imiê i nazwisko:</td>
<td><input type="text" name="name" style="width:300px"></td>
</tr>

<tr>
<td width=110>Uprawnienia:</td>
<td>
<SELECT NAME="access" style="width:100px">
<OPTION value="user"> U¿ytkownik
<OPTION value="admin"> Administrator
</SELECT></td>
</tr>


<tr>
<td width=110>Klasa:</td>
<td>
<SELECT NAME="class" style="width:100px">
<OPTION value="" selected> Brak
<loop:classes>
<OPTION value="<tag:classes[].id />"> <tag:classes[].name />
</loop:classes>
</SELECT></td>
</tr>



</table>
<br>
<br>
<center><input type="submit" value="Dodaj"></center>
</form>

</td></tr>
<tr height=2>
<td class=tabbottom align=center colspan=1>
</td>
</tr>
</table>
