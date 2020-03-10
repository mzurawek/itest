<table border="0" width=100% class=modul style="border: 0.3mm solid #376BD9">
<tr height=3>
<td bgcolor="#376BD9" class=tabcaption  align=center colspan=2>
<font color=white><b>Dodaj test</b></font>
</td>
</tr>
<tr height=3>
<td bgcolor="#B8CEF3" align=left>


<form action="admin.php?action=tests&subaction=add_save" ACCEPT-CHARSET="iso-8859-2" method=post>
<table width=100% class=modul>
<tr>
<td width=90>Tytu³ testu:</td>
<td><input type="text" name="title" style="width:500px"></td>
</tr>
<tr>
<td width=90>Dodatkowa adnotacja:</td>
<td><textarea rows=4 name="desc" style="width:500px"></textarea></td>
</tr>


<tr>
<td width=90>Dostêp do testu:</td>
<td>
<SELECT NAME="access">
<OPTION value="1"> Tylko administratorzy
<OPTION value="2"> Tylko u¿ytkownicy zalogowani
<OPTION value="3" selected> Wszyscy
</SELECT>
</td>
</tr>


<tr>
<td width=90 align=center><input type="text" name="fill_time" value="0" style="width:50px"></td>
<td>ograniczenie czasowe wype³niania testu (w minutach)</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="random_questions"></td>
<td>wy¶wietlaj pytania w losowej kolejno¶ci</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="block_after"></td>
<td>blokuj test na 5 minut po jego wype³nieniu (dotyczy trybu Go¶æ)</td>
</tr>

<tr>
<td width=90 align=center><input type="checkbox" name="no_crib"></td>
<td>aktywuj system zapobiegaj±cy ¶ci±ganiu</td>
</tr>

</table>
<br>
<center>
<input type="submit" value="Dodaj test">
</center>
</form>

</td></tr>
<tr height=2>
<td bgcolor="#376BD9" class=tabbottom align=center colspan=2>
</td>
</tr>
</table>
<br><br>

<table width=60% class=modul align=center>
<tr>
<td>
<i>Pamiêtaj, ¿e aby test po dodaniu go przez Ciebie mo¿na by³o wype³niaæ, musisz go jeszcze aktywowaæ w panelu zarz±dzania testami.</i>
</td>
</tr>
</table>
