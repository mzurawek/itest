<center>
<font size="4"><b><tag:test.title /></b></font>
</center>
<p align=justify>
<i><tag:test.desc /></i>
</p>
<br>


<if:is_fill_time>
<!--
startday = new Date();
clockStart = startday.getTime();
-->

<script>

window.setTimeout('getSecs()',1);

var container = 0;

clockStart = <tag:script_start_time />;

function initStopwatch()
{
        var myTime = new Date();
        container = 1000 + container;
        var timeDiff = container;
        this.diffSecs = timeDiff/1000;
        return(this.diffSecs);
}
function getSecs()
{
        var mySecs = initStopwatch();
        var mySecs1 = ""+mySecs;

        document.tijd.hiero.value=Math.round(mySecs1/60)
        window.setTimeout('getSecs()',1000);

   if (mySecs1==<tag:fill_time_alert_seconds />) {alert("Uwa¿aj, za minutê musisz zakoñczyæ wype³nianie testu!") }

        if (mySecs1==<tag:fill_time_seconds />) {
document.test.timeout.value = 'yes'
document.test.submit()

        }

}


</script>


<form name="tijd">
<center>
<font color=red>Uwaga!</font> Test trwa tylko <tag:test.fill_time /> minut/y, a wype³niasz go juz minut: <input type="text" size=1 name=hiero align=center></form>
</if:is_fill_time>
<br>
Godzina rozpoczêcia testu: <tag:start_time_text />.<br>Pamiêtaj! Tylko jedna odpowied¼ jest prawid³owa.
<br><br>
<SCRIPT LANGUAGE="JavaScript">
<!--
function checkform ( form )
{

if(document.test.timeout.value=='no')
{

if(<loop:questions_array> <tag:questions_array[].or /> (document.test.question_<tag:questions_array[].id />[0].checked == false && document.test.question_<tag:questions_array[].id />[1].checked == false && document.test.question_<tag:questions_array[].id />[2].checked == false && document.test.question_<tag:questions_array[].id />[3].checked == false) </loop:questions_array>)

 return confirm("Nie udzieli³e¶ odpowiedzi na wszystkie pytania. Czy na pewno chcesz zakoñczyæ ju¿ pisanie testu?");
}


 if(document.test.timeout.value=='no')
    return confirm("Czy na pewno chcesz ju¿ zakoñczyæ pisanie testu?");
 else return true;

}
//-->
</SCRIPT>


<form action="results.php?test_id=<tag:test.id />" ACCEPT-CHARSET="iso-8859-2" method=post name="test" onsubmit="return checkform(this);">
<input type=hidden name="timeout" value="no">
<input type=hidden name="start_time" value="<tag:start_time />">
<input type=hidden name="guest_name" value="<tag:guest_name />">
<input type=hidden name="mode" value="<tag:mode />">

<hr size=1 color=gray>
<loop:questions_text>
<tag:questions_text[] />
</loop:questions_text>
<br><br>
<input type="submit" value="Zakoñcz pisanie testu">

</form>
