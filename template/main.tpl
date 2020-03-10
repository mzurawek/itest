<script>
function checkform(form) {

if (form.guest_name.value == "") {
  alert("Musisz podaæ swoje imiê i nazwisko!")
  form.guest_name.focus()
  return false}


return true;

}
</script>

<!-- <center>Witaj w systemie iTest!</center>
<br>--> <br>

<table width="95%" style="border: 0.3mm solid #376BD9" class=modul align=center>

<tr><td class=tabcaption colspan=3>
<center>&#176; <b>Wybierz tryb logowania</b> &#176;</center>
</td></tr>
<tr>
<td width=33% align=center bgcolor="#B6C9F1" valign=center>
<!-- uzytkownik -->
<table width="95%" style="border: 0.3mm solid #376BD9" class=modul align=center>
<tr><td bgcolor="#376BD9" class=tabcaption colspan=3>
<center><b>U¿ytkownik</b></center>
</td></tr>
<tr>

<td align=center bgcolor="#D5DFF7">
<font style="font-size:5px"><br></font>
<center><img src="lay/forums.png" width="48" height="48"></center>
<font style="font-size:5px"><br></font>
Je¿eli posiadasz swoje konto w systemie
<a href="login.php?desturl=dGVzdC5waHA="><u>kliknij tutaj</u></a> aby zalogowaæ siê i wype³niæ test.
<br><br>
</td>

</tr>
<tr height=2>
<td class=tabbottom colspan=3 align=center>
</td>
</tr>
</table>
<!-- end: uzytkownik -->
</td>
<td width=33% align=center bgcolor="#B6C9F1">
<!-- gosc -->
<table width="95%" style="border: 0.3mm solid #376BD9" class=modul align=center>
<tr><td bgcolor="#376BD9" class=tabcaption colspan=3>
<center><b>Go¶æ</b></center>
</td></tr>
<tr>

<td align=center bgcolor="#D5DFF7">
<font style="font-size:5px"><br></font>
<center><img src="lay/guest.png" width="43" height="47"></center>
<font style="font-size:5px"><br></font>
<form name="guest_login" action="test.php" ACCEPT-CHARSET="iso-8859-2" method=post onsubmit="return checkform(this);">
Je¿eli nie posiadasz w³asnego konta w systemie podaj swoje imiê i nazwisko:<br><input type=text name="guest_name">
<input type=submit name="gosc" value="Rozpocznij test">
</form>
</td>

</tr>
<tr height=2>
<td bgcolor="#376BD9" colspan=3 class=tabbottom align=center>
</td>
</tr>
</table>
<!-- end: gosc -->
</td>
<td width=33% align=center bgcolor="#B6C9F1" valign=center>
<!-- admin -->
<table width="95%" style="border: 0.3mm solid #7F7F7F" class=modul align=center>
<tr><td class=tabcaption_a colspan=3>
<center><b>Administrator</b></center>
</td></tr>
<tr>
<td align=center bgcolor="#E2E3E9">
<font style="font-size:5px"><br></font>
<center><img src="lay/settings.png" width="48" height="48"></center>
<font style="font-size:5px"><br></font>
<a href="login.php?desturl=YWRtaW4ucGhw"><u>Kliknij tutaj</u></a> aby zarz±dzaæ systemem.
<br><br>
</td>

</tr>
<tr height=2>
<td bgcolor="#7F7F7F" class=tabbottom_a colspan=3 align=center>
</td>
</tr>
</table>
<!-- end: admin -->
</td>

</tr>
<tr height=2>
<td bgcolor="#376BD9" colspan=3 class=tabbottom align=center>
</td>
</tr>
</table>
