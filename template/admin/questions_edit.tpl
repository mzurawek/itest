
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
<font color=white><b>Edytuj pytanie</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>

<form action="admin.php?action=questions&subaction=edit_save&test_id=<tag:test_id />&id=<tag:question.id />" ACCEPT-CHARSET="iso-8859-2" name="add" onsubmit="return checkform(this);" method=post>
<table width=100% class=modul>
<tr>
<td width=75>Pytanie:</td>
<td><textarea rows=4 name=question maxlength=254 style="width:350px"><tag:question.question /></textarea></td>
</tr>
<tr>

<td colspan=2>
<table width=100%>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="1" <tag:question.answer_1_checked />></td><td><input type="text" name="answer1" style="width:350px" value="<tag:question.answer1 />"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="2" <tag:question.answer_2_checked />></td><td><input type="text" name="answer2" style="width:350px" value="<tag:question.answer2 />"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="3" <tag:question.answer_3_checked />></td><td><input type="text" name="answer3" style="width:350px" value="<tag:question.answer3 />"></td></tr>
<tr><td width=75><INPUT TYPE="radio" NAME="correct_answer" VALUE="4" <tag:question.answer_4_checked />></td><td><input type="text" name="answer4" style="width:350px" value="<tag:question.answer4 />"></td></tr>

</table>


<td></td>
</tr>


</table>
<br>
<center>
<input type="submit" value="Zapisz zmiany">
</center>
</form>

</td></tr>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=2>
</td>
</tr>
</table>

