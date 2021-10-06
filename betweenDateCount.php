on form:-
<input name="txt_from" type="date" maxlength="10"  id="txt_from" class="calendar" />
<input name="txt_to" type="date" maxlength="10"  id="txt_to" class="calendar" />

$("#txt_to").blur(function(){
    var start  =$("#txt_from").val();
    var end  = $("#txt_to").val();
    var days=(Date.parse(end) - Date.parse(start)) / 86400000;
    $("#txt_tot_prog_day").attr('value',days);
});





count days between two days:-
$("#txt_to").blur(function(){
	var start  =$("#txt_from").val();  //from 
	var end  = $("#txt_to").val();  //to
	var days=(Date.parse(end) - Date.parse(start)) / 86400000;
	$("#txt_tot_prog_day").attr('value',days);  //jaha pe total day show karna ho
});


to date hamesa from date se jyada hona chahiye:-
$("#txt_to").focus(function(){
	var txt_from= $("#txt_from").val();  //from kar value recived
	$("#txt_to").attr('min',txt_from);  //to me min ka attribute add liya
});
