<table width=100% class=modul>
<tr>

<td <if:no_crib> style="color:silver" onmouseout="this.style.color='silver';" onmouseover="this.style.color='#000000';" </if:no_crib>>

<b><tag:question.question /></b><br><br>
<if:show_answer1><INPUT TYPE="radio" NAME="question_<tag:question.id />" VALUE="<tag:question.randed_answer1_nr />"><tag:question.randed_answer1 /><br></if:show_answer1>
<if:show_answer2><INPUT TYPE="radio" NAME="question_<tag:question.id />" VALUE="<tag:question.randed_answer2_nr />"><tag:question.randed_answer2 /><br></if:show_answer2>
<if:show_answer3><INPUT TYPE="radio" NAME="question_<tag:question.id />" VALUE="<tag:question.randed_answer3_nr />"><tag:question.randed_answer3 /><br></if:show_answer3>
<if:show_answer4><INPUT TYPE="radio" NAME="question_<tag:question.id />" VALUE="<tag:question.randed_answer4_nr />"><tag:question.randed_answer4 /><br></if:show_answer4>
</td>


</tr>
</table>
<hr size=1 color=gray>

