<script>
function checkform(form) {

if (form.guest_name.value == "") {
  alert("Musisz podaæ swoje imiê i nazwisko!")
  form.guest_name.focus()
  return false}


return true;

}
</script>
<center>
<font style="font-size:20px">
<tag:test.title />

</font>
<br><br><i><tag:test.desc /></i><br><br>
</center>

<!-- gosc -->
<table width="95%" style="border: 0.3mm solid #376BD9" class=modul align=center>
<tr><td bgcolor="#376BD9" class=tabcaption colspan=3>
<center><b>Rozpoczynanie wype³niania testu</b></center>
</td></tr>
<tr>

<td align=center bgcolor="#D5DFF7">
<font style="font-size:5px"><br></font>

<form name="guest_login" action="test.php?mode=2" ACCEPT-CHARSET="iso-8859-2" method=post onsubmit="return checkform(this);">
Aby wype³niæ test podaj swoje imiê i nazwisko:<br><font style="font-size:5px"><br></font><input type=text name="guest_name"><br><font style="font-size:5px"><br></font>
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

