<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<TITLE>iTest - drukowanie testu</TITLE>
<META http-equiv=content-language content=pl>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-2">
<META name=keywords content="">
<META name=description content="">
<META name=Author content=intol>
<META name=Copyright content=intol>
<META name=revisit-after content="14 days">
<META content=index,follow name=robots>
</HEAD>
<BODY onLoad="javascript:window.print(); return false" BGCOLOR="#FFFFFF" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>


<center>
<font size="4"><b><tag:test.title /></b></font>
</center>
<p align=justify>
<i><tag:test.desc /></i>
</p>
<br>

<center>
<if:is_fill_time>
Uwaga! Na wypełnienie testu masz tylko <tag:test.fill_time /> minut/y.
<br>
</if:is_fill_time>
Pamiętaj! Tylko jedna odpowiedź jest prawidłowa.
</center>
<br><br>
<tag:questions />
<br><br>

</body>
</html>
