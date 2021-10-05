after click check box:-
$("#mychk").click(function () {
	if ($(this).is(":checked")) {
		$("#demo").removeAttr("disabled");//here you perform task
	} else {
		$("#demo").attr("disabled", "disabled");
	}
});



