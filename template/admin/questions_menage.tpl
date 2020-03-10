<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption align=center colspan=7>
<font color=white><b>Podgl±d testu</b></font>
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
<td bgcolor="#3F6AC9" align=center width=70>
</td>
<td bgcolor="#3F6AC9" align=center width=40>
</td>
<td bgcolor="#3F6AC9" align=center width=40>
</td>
</tr>

<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b>&#187;</b></center></font></td>
<td  bgcolor="#B8CEF3" align=left><tag:test.title /></td>
<td  bgcolor="#B8CEF3" align=center width=140><tag:test.time_create_text /></td>
<td  bgcolor="#B8CEF3" align=center width=70><a href="admin.php?action=tests&subaction=menage_edit&test_id=<tag:test.id />">Ustawienia</a></td>
<td  bgcolor="#B8CEF3" align=center width=40><a href="admin.php?action=tests&subaction=menage_delete&test_id=<tag:test.id />">Usuñ</a></td>
<td  bgcolor="#B8CEF3" align=center width=40><tag:test.activate_link /></td>
</tr>

<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=7>
</td>
</tr>
</table>

<br><br>

<if:not_empty>
<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption align=center colspan=7>
<font color=white><b>Pytania do testu</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#3F6AC9" align=center width=20>
<font color=white>#</font>
</td>
<td bgcolor="#3F6AC9" align=center>
<font color=white>Pytanie</font>
</td>
<td bgcolor="#3F6AC9" align=center width=200>
<font color=white>Odpowiedzi</font>
</td>
<td bgcolor="#3F6AC9" align=center width=60>
</td>
<td bgcolor="#3F6AC9" align=center width=40>
</td>
</tr>

<loop:questions>
<tr>
<td bgcolor="#618CDF" width=20><font color=white><center><b><tag:questions[].nr />.</b></center></font></td>
<td bgcolor="#B8CEF3" align=left><tag:questions[].question /></td>
<td bgcolor="#B8CEF3" align=center width=200>
<!-- odp -->
<table class=modul width=100% border=0>
<tr><td>&#176; <tag:questions[].answer1 /></td></tr>
<tr><td>&#176; <tag:questions[].answer2 /></td></tr>
<tr><td>&#176; <tag:questions[].answer3 /></td></tr>
<tr><td>&#176; <tag:questions[].answer4 /></td></tr>

</table>
<!-- end: odp -->
</td>
<td bgcolor="#B8CEF3" align=center width=60><tag:questions[].edit_link /></td>
<td bgcolor="#B8CEF3" align=center width=40><tag:questions[].delete_link /></td>
</tr>
</loop:questions>


<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=7>
</td>
</tr>
</table>
<else:not_empty>
<center>Brak dodanych pytañ!</center>
</if:not_empty>

<br><br>
<!-- DODAWANIE NOWEGO -->

<SCRIPT LANGUAGE="JavaScript">
<!--
function checkform ( form )
{
   if(document.add.correct_answer[0].checked == true)
   {
     if(document.add.answer1.value == '')
     {
        alert('Musisz podaæ tekst odpowiedzi prawid³owej.'); return false;
     }
   }
   if(document.add.correct_answer[1].checked == true)
   {
     if(document.add.answer2.value == '')
     {
        alert('Musisz podaæ tekst odpowiedzi prawid³owej.'); return false;
     }
   }
   if(document.add.correct_answer[2].checked == true)
   {
     if(document.add.answer3.value == '')
     {
        alert('Musisz podaæ tekst odpowiedzi prawid³owej.'); return false;
     }
   }
   if(document.add.correct_answer[3].checked == true)
   {
     if(document.add.answer4.value == '')
     {
        alert('Musisz podaæ tekst odpowiedzi prawid³owej.'); return false;
     }
   }
   return true;
}
-->
</script>




<table border="0" width=425 class=modul align=center style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption align=center colspan=2>
<font color=white><b>Dodaj nowe pytanie</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>

<form action="admin.php?action=questions&subaction=add_save" name="add" onsubmit="return checkform(this);" ACCEPT-CHARSET="iso-8859-2" method=post>
<input type=hidden name="test_id" value="<tag:test.id />">
<table width=100% class=modul>
<tr>
<td width=75>Pytanie:</td>
<td><textarea rows=4 name=question maxlength=254 style="width:350px"></textarea></td>
</tr>
<tr>

<td colspan=2>
<table width=100%>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="1" checked></td><td><input type="text" name="answer1" style="width:350px"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="2"></td><td><input type="text" name="answer2" style="width:350px"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="3"></td><td><input type="text" name="answer3" style="width:350px"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="4"></td><td><input type="text" name="answer4" style="width:350px"></td></tr>

</table>


<td></td>
</tr>


</table>
<br>
<center>
<input type="submit" value="Dodaj">
</center>
</form>

</td></tr>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=2>
</td>
</tr>
</table>
