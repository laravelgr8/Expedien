on form:-
<input name="txt_from" type="date" maxlength="10"  id="txt_from" class="calendar" />
<input name="txt_to" type="date" maxlength="10"  id="txt_to" class="calendar" />

$("#txt_to").blur(function(){
    var start  =$("#txt_from").val();
    var end  = $("#txt_to").val();
    var days=(Date.parse(end) - Date.parse(start)) / 86400000;
    $("#txt_tot_prog_day").attr('value',days);
});
